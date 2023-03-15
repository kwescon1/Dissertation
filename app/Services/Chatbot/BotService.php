<?php

namespace App\Services\Chatbot;

use Carbon\Carbon;
use App\Models\Reply;
use App\Models\Client;
use App\Models\Question;
use App\Models\Conversation;
use App\Services\Chatbot\Constants;
use Illuminate\Support\Facades\Log;

class BotService extends InitService
{
    //
    public function getOrcreateSession($request)
    {

        $reply = Reply::latest()->where('from', $request->From)->first();

        if (!$reply) {

            //check for user registration
            $clientNumber = $this->getActualWhatsappNumber($request->From);

            $branchNumber = $this->getActualWhatsappNumber($request->To);

            $client = $this->getClient($branchNumber, $clientNumber);

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

        logger("media is $media");

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
        Log::warning("data is" . json_encode($data));

        return call_user_func([$this, $data['question']->method], $data);
    }


    /**
     * @param $branchPhoneNumber
     * $clientPhoneNumber
     * @return object|NULL
     * 
     * get client belonging to a facility branch
     */
    protected function getClient(string $branchPhoneNumber, string $clientPhoneNumber): ?object
    {
        return Client::join('facility_branches', 'clients.facility_id', '=', 'facility_branches.facility_id')->where("facility_branches.phone", $branchPhoneNumber)->where('clients.phone', $clientPhoneNumber)->first();
    }
}
