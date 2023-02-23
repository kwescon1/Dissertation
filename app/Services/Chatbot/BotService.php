<?php

namespace App\Services\Chatbot;

use App\Models\Reply;
use App\Models\Question;
use App\Services\Chatbot\Constants;
use Illuminate\Support\Facades\Log;

class BotService extends InitService
{
    //
    public function getOrcreateSession($request)
    {

        $reply = Reply::latest()->where('from', $request->From)->first();

        if (!$reply) {

            //user hasn't started any session yet
            return Constants::INIT;
        }

        $questionNumber = $reply->question_id;

        //if answer exists, evaluate and return next Question ID

        $question = Question::find($questionNumber);

        $nextId = $this->runMethod([
            'reply' => $reply,
            'question' => $question,
            'body' => trim($request->Body),
            'mediaUrl' => "$request->MediaUrl0",
            'from' => $request->From
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

    //runs specific methods
    public function runMethod($data)
    {
        Log::warning("data is" . json_encode($data));

        return call_user_func([$this, $data['question']->method], $data);
    }
}
