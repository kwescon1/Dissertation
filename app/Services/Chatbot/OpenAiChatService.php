<?php

namespace App\Services\Chatbot;

use Illuminate\Support\Carbon;
use App\Mail\OpenAIConnecionFailed;
use App\Services\Chatbot\Constants;
use App\Mail\OpenAIConnectionFailed;
use App\Models\OpenAiMessageTracker;
use Illuminate\Support\Facades\Mail;
use App\Services\Chatbot\Appointment\InitAppointmentService;

class OpenAiChatService extends InitAppointmentService
{

    public function onAskQuestionProvided($data)
    {

        $str = trim(strtolower($data['body']));

        if ($str == "end") {
            return $this->saveAnswer($data, Constants::DONE);
        }

        rescue(function () use ($str, $data) {

            $output = $this->chat($str);

            //track message
            $this->trackMessage($data['from']);

            collect(explode("\n\n", $output))->each(function ($msg) use ($data) {
                $this->sendReply($data['from'], $msg);
                sleep(2);
            });
        }, function ($exception) use ($data) {

            logger($exception->getMessage());

            Mail::to(config('mail.notif_email'))->send(new OpenAIConnectionFailed($exception->getMessage(),Carbon::now()));

            return $this->sendReply($data['from'], "Oops I'm having some connection issues, please try again.");

        }, false);
    }


    private function trackMessage(string $from){

        return OpenAiMessageTracker::updateOrCreate(
            ['from' => $from,],
            ['message_time' => Carbon::now()]
        );
    }


    /**
     * automatically end inactive session after 5 mins
     */
    public function endOpenAiInactiveSession(string $from){

        return $this->sendReply($from, "Session has been ended due to inactivity‼️");
    }
}
