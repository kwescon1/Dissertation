<?php

namespace App\Services\Chatbot;

use App\Services\Chatbot\Appointment\InitAppointmentService;
use App\Services\Chatbot\Constants;

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

            $paragraphs = explode("\n\n", $output);

            foreach ($paragraphs as $p) {
                $this->sendReply($data['from'], $p);

                sleep(2);
            }

            die;
        }, function ($exception) use ($data) {

            //trigger event to send email TODO
            logger($exception->getMessage());

            $this->sendReply($data['from'], "Oops I'm having some connection issues, please try again.");

            die;
        }, false);
    }
}
