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

                return Constants::DONE;

                break;

            case '2':

                return $this->saveAnswer($data, Constants::OPEN_AI_CHAT);

                break;

            case '3':
                return Constants::DONE;
                break;

            default:
                //choose from options
                return Constants::CHOOSE_FROM_AVAILABLE_OPTIONS;
                break;
        }
    }





    private function initialPrompt()
    {
        return "";
    }
}
