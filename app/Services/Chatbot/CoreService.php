<?php

namespace App\Services\Chatbot;

use App\Traits\ChatBotTrait;
use App\Services\OpenAI\OpenAI;
use App\Services\Whatsapp\Whatsapp;
// use Twilio\Rest\Client as CLi;
// use Illuminate\Support\Facades\Log;


class CoreService
{

    use ChatBotTrait;

    private $openAi;
    private $whatsapp;

    public function __construct(OpenAI $openAi, Whatsapp $whatsapp)
    {
        $this->openAi = $openAi;
        $this->whatsapp = $whatsapp;
    }


    /**
     * @param string $prompt
     * open ai chat
     * 
     */
    public function chat($prompt)
    {
        return $this->openAi->openAiCompletion(trim($prompt));
    }

    /**
     * @param string $from
     * @param string $message
     * @param string $media
     * 
     * send message replies
     */
    public function sendReply(string $from, string $message, string $media = NULL)
    {
        return $this->whatsapp->messageClient($from, $message, $media);
    }
}
