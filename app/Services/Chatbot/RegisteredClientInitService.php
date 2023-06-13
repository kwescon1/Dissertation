<?php

namespace App\Services\Chatbot;

use Carbon\Carbon;
use App\Services\Chatbot\Constants;
use Illuminate\Support\Facades\URL;

class RegisteredClientInitService extends OpenAiChatService
{
    public function registeredClientStartQuestion($data)
    {

        switch ($data['body']) {
            case '1':

                return $this->saveAnswer($data, Constants::APPOINTMENTS); //appointments
                break;

            case '2':

                return $this->saveAnswer($data, Constants::MEDICAL_RECORDS); //medical records
                break;

            case '3':

                return $this->saveAnswer($data, Constants::OPEN_AI_CHAT); //Ask a question

                break;

            case '4':
                return $this->saveAnswer($data, Constants::HELP); //make enquiries
                break;

            case '5':
                return $this->saveAnswer($data, Constants::DONE); // Quit
                break;

            default:
                //choose from options
                return Constants::CHOOSE_FROM_AVAILABLE_OPTIONS;
                break;
        }
    }
}
