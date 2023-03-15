<?php

namespace App\Services\Chatbot;

use Carbon\Carbon;
use App\Services\Chatbot\Constants;
use Exception;
use Illuminate\Support\Facades\URL;

class OpenAiChatService extends CoreService
{
    public function onAskQuestionProvided($data)
    {
        //TODO use try catch here in case openai fails
        $str = trim(strtolower($data['body']));

        if ($str == "end") {
            return $this->saveAnswer($data, Constants::DONE);
        }

        try {

            $output = $this->openAiCompletion($str);

            $paragraphs = explode("\n\n", $output);

            foreach ($paragraphs as $p) {
                $this->sendReply($data['from'], $p);

                sleep(2);
            }

            die;
        } catch (Exception $e) {
            return $this->sendReply($data['from'], "Oops I'm having some connection issues, please try again.");
        }
    }
}
