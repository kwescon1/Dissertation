<?php

namespace App\Services\Chatbot;

use Carbon\Carbon;
use App\Services\Chatbot\Constants;
use Illuminate\Support\Facades\URL;

class RegisteredClientInitService extends OpenAiChatService
{
    public function registeredClientStartQuestion($data)
    {

        return match ($data['body']) {
            '1' => $this->saveAnswer($data, Constants::APPOINTMENTS), //appointments
            '2' => $this->saveAnswer($data, Constants::MEDICAL_RECORDS), //medical records
            '3' => $this->saveAnswer($data, Constants::HELP), //make enquiries
            '4' => $this->saveAnswer($data, Constants::DONE), // Quit
            
            default => Constants::CHOOSE_FROM_AVAILABLE_OPTIONS,
        };
    }
}
