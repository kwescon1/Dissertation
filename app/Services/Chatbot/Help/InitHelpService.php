<?php

namespace App\Services\Chatbot\Help;

use App\Services\Chatbot\Constants;
use App\Services\Chatbot\CoreService;

class InitHelpService extends CoreService
{
    public function initHelpQuestion(array $data)
    {
        return match ($data['body']) {
            '1' => $this->saveAnswer($data, Constants::OPEN_AI_CHAT),
            '2' => $this->saveAnswer($data, Constants::FAQ),
            '3' => $this->saveAnswer($data,Constants::REGISTERED_USER_START_QUESTION_ID),
            '4' => $this->saveAnswer($data, Constants::DONE), // Quit

            default => Constants::CHOOSE_FROM_AVAILABLE_OPTIONS,
        };
    }
}
