<?php

namespace App\Services\Chatbot;

use App\Models\Reply;
use App\Models\Conversation;
use Twilio\Rest\Client as CLi;
// use Twilio\TwiML\MessagingResponse;

class CoreService
{
    /**
     * @param string $from
     * @return void
     * 
     * end current user session
     */
    function setToDone(string $from): void
    {
        Reply::where('from', $from)->delete();
    }

    /**
     * @param int $questionId
     * @param string $from
     * @return string/null
     * 
     * grabs reply to each question
     */
    function grabAnswerByQuestionId(int $questionId, string $from): ?string
    {
        $reply = Reply::latest()->where("from", $from)->where("question_id", $questionId)->first();

        return isset($reply) ? $reply->answer : "";
    }

    /**
     * @param string $whatsappNumber
     * @return string
     * 
     * get actual whatsapp numbers of users
     */
    function getActualWhatsappNumber(string $whatsappNumber): string
    {
        return str_replace('whatsapp:', '', $whatsappNumber);
    }

    /**
     * @param string $from
     * @param string $message
     * @param string $media
     * 
     * send message replies
     */

    function sendReply(string $from, string $message, string $media = NULL)
    {
        logger("chatbot message body is\n $message \nand media is $media\n");

        $twilio_number = config('twilio.twilio_number');

        $twilio = $this->configureTwilio();

        return $twilio->messages->create($from, $this->checkMedia($message, $twilio_number, $media));
    }

    /**
     * @param string $message
     * @param string $number
     * @param $media
     * 
     * @return array
     * 
     * adds media to returned array if media exists
     */
    function checkMedia(string $message, string $number, $media = NULL): array
    {

        return !isset($media) ? array(
            "body" => $message,
            "from" => $number,
            "statusCallback" => url("/api/status")
        ) : array(
            "body" => $message,
            "from" => $number,
            "MediaUrl" =>  asset("storage/media/$media"),
            "statusCallback" => url("/api/status")
        );
    }

    /**
     * @param array $data
     * @param int $nextId
     * @return int
     * 
     * save replies from user
     */
    function saveAnswer(array $data, int $nextId): int
    {
        $reply = $data["reply"];

        if (isset($reply)) {
            $reply->answer = $data["body"];
            $reply->next_id = $nextId;
            $reply->save();
        }

        return $nextId;
    }

    /**
     * @param array $data
     * @param Request $request
     * @return void
     * 
     * save conversation between user and chatbot
     */
    function createConversation($request): void
    {
        Conversation::create([
            'SmsMessageSid' => $request->SmsMessageSid,
            'body' => $request->Body,
            'from' => $request->From,
            'media' => $request->MediaUrl0
        ]);
    }

    /**
     * 
     * @param string $from
     * @return void
     * 
     * restart user current session
     */
    function startAgain(string $from)
    {
        $one = Reply::latest()->where("from", $from)->first();

        if (isset($one)) {
            $one->delete();

            $two = Reply::latest()->where("from", $from)->first();
            if (isset($two)) {

                $two->delete();

                $lastAnswer = Reply::latest()->where("from", $from)->first();

                if (!isset($lastAnswer)) {
                    $this->setToDone($from);
                } else {
                    //TODO come back to this
                    // $this->sendNextQuestion($lastAnswer->next_id, $from);

                    $lastAnswer->delete();

                    return;
                }
            } else {
                $this->setToDone($from);
            }
        } else {
            $this->setToDone($from);
        }
    }

    /**
     * 
     * configure twilio messaging
     */
    private function configureTwilio()
    {
        $account_sid = config('twilio.twilio_sid');
        $auth_token = config('twilio.twilio_auth_token');

        return new CLi($account_sid, $auth_token);
    }
}
