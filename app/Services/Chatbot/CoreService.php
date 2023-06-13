<?php

namespace App\Services\Chatbot;

use App\Models\Client;
use App\Traits\ChatBotTrait;
use App\Services\OpenAI\OpenAI;
use App\Services\Whatsapp\Whatsapp;


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

    /**
     * @param $branchPhoneNumber
     * $clientPhoneNumber
     * @return object|NULL
     * 
     * get client belonging to a facility branch
     */
    public function getClient(string $branchPhoneNumber, string $clientPhoneNumber): ?object
    {
        return Client::leftJoin('facility_branches', 'clients.facility_id', '=', 'facility_branches.facility_id')->where("facility_branches.phone", $branchPhoneNumber)->where('clients.phone', $clientPhoneNumber)->with('clientAccount')->select('clients.*')->first();
    }
}
