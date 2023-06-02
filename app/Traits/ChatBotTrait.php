<?php

namespace App\Traits;

use App\Models\Reply;
use App\Models\Conversation;

trait ChatBotTrait
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
     * @param string $number
     * @return string
     * 
     * get replace whatsapp numbers of users
     */
    function replaceActualWhatsappNumber(string $number): string
    {
        return str_replace('+', 'whatsapp:+', $number);
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
            // $user_feedback->media = $data['mediaUrl'];
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
    function restart(string $from)
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
}
