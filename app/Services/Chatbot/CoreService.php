<?php

namespace App\Services\Chatbot;

use App\Models\Reply;
use App\Models\Conversation;
use App\Services\OpenAI\OpenAI;
use Twilio\Rest\Client as CLi;
use Illuminate\Support\Facades\Log;


class CoreService
{

    private $openAi;

    public function __construct(OpenAI $openAi)
    {
        $this->openAi = $openAi;
    }
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

        return  $twilio->messages->create($from, $this->checkMedia($message, $twilio_number, $media));
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
        return !isset($media) ? $this->hasNoImage($message, $number)
            : $this->hasImage($message, $number, $media);
    }


    private function hasImage(string $message, string $number, $media)
    {
        //verify image
        $isImage = $this->verifyIsImage($media);

        return $isImage ? array(
            "body" => $message,
            "from" => $number,
            "MediaUrl" =>  asset("storage/media/$media"),
            "statusCallback" => url("/api/status")
        ) : $this->hasNoImage($message, $number);
    }

    private function hasNoImage(string $message, string $number)
    {
        return array(
            "body" => $message,
            "from" => $number,
            "statusCallback" => url("/api/status")
        );
    }

    private function verifyIsImage($media): bool
    {
        $image = asset("storage/media/$media");

        return rescue(function () use ($image) {
            // Read the contents of the file into a string
            $file_contents = file_get_contents($image);

            // Get the image size from the string
            $image_size = getimagesizefromstring($file_contents);

            // Check if the image size was successfully retrieved and the file is an image
            return $image_size !== false && strpos($image_size['mime'], 'image') === 0 ? true : false;
        }, function ($e) {
            Log::info("Failed to read file");
            return false;
        });
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

    function chat($prompt)
    {
        return $this->openAi->openAiCompletion($prompt);
    }
}
