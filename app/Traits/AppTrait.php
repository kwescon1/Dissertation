<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Reply;
use App\Models\Client;
use App\Models\Question;
use App\Models\Conversation;
use App\Services\Chatbot\Constants;
use Illuminate\Support\Facades\Log;

trait AppTrait
{
    //
    const HELLO = "Hello";
    const HI = "Hi";
    const RESTART = "Restart";

    public function getOrcreateSession($request)
    {

        $reply = Reply::latest()->where('from', $request->From)->first();

        if (!$reply) {

            //check for user registration
            $clientNumber = $this->getActualWhatsappNumber($request->From);

            $branchNumber = $this->getActualWhatsappNumber($request->To);

            $client = $this->getClient($branchNumber, $clientNumber);

            if(trim(strtolower($request->Body)) != strtolower(self::HELLO) && strtolower($request->Body) != strtolower(self::HI) && strtolower($request->Body) != strtolower(self::RESTART)){
                return;
            }

            if (!$client) {
                //user hasn't registered
                return Constants::INIT;
            }

            //return init question id for registered User
            return Constants::REGISTERED_USER_START_QUESTION_ID;
        }

        $questionNumber = $reply->question_id;

        //if answer exists, evaluate and return next Question ID

        $question = Question::find($questionNumber);

        $nextId = $this->runMethod([
            'reply' => $reply,
            'question' => $question,
            'body' => trim($request->Body),
            'mediaUrl' => "$request->MediaUrl0",
            'from' => $request->From,
            'to' => $request->To
        ]);

        return $nextId;
    }

    //send reply to all messages received by bot

    public function sendMessageReply($from, $message, $questionId)
    {
        Reply::create([
            "question_id" => $questionId,
            "from" => $from,
            "question" => Question::find($questionId)->question,
        ]);

        $file = Question::where('id', $questionId)->first();

        $media = $file['media'];

        Log::info("media is $media");

        $this->sendReply($from, $message, $media);
    }

    /**
     * 
     * @param $client
     * @return object|NULL
     */

    function lastSentMessage(string $from): ?object
    {
        return Conversation::latest()->where('from', $from)->first();
    }

    /**
     * @param $timeCreated
     * @param $from
     * 
     * ends the users previous session if time difference between previous and current session is >= 30 minutes
     */
    function verifyTimeDifference($timeCreated, $from)
    {
        $past_time = Carbon::parse($timeCreated);
        $current_time = Carbon::now();

        $time_diff = $past_time->diffInMinutes($current_time);

        if ($time_diff >= 30) {
            $this->setToDone($from);
        }
    }

    //runs specific methods
    public function runMethod($data)
    {
        Log::info("data is" . json_encode($data));

        return call_user_func([$this, $data['question']->method], $data);
    }
}
