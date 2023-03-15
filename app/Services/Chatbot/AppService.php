<?php

namespace App\Services\Chatbot;

use App\Models\Question;
use App\Services\Chatbot\Constants;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AppService extends BotService
{
    /**
     * @param $data
     * 
     * chatbot entry point
     */
    public function messageReceived($data)
    {

        // get last message sent to bot by client
        $lastMessage = $this->lastSentMessage($data->From);

        if ($lastMessage) {
            $this->verifyTimeDifference($lastMessage->created_at, $data->From);
        }


        $this->createConversation($data);

        if (trim(strtolower($data->Body)) == "restart") {

            $this->setToDone($data->From);
        } else if (trim(strtolower($data->Body)) == "back" || trim(strtolower($data->Body)) == "go back") {

            $this->restart($data->From);
        }

        $nextQuestionId = $this->getOrcreateSession($data);

        if ($nextQuestionId == Constants::CHOOSE_FROM_AVAILABLE_OPTIONS) {
            $str = "Please choose from the options provided ❤️";

            $this->sendReply($data->From, $str);

            return;
        }

        if ($nextQuestionId == Constants::DONE) {

            $string = "Thank you for using our services❤️";

            $this->sendReply($data->From, $string);

            return $this->setToDone($data->From);
        }

        logger("chatbot nextQuestionId is $nextQuestionId");

        $nextQuestion = $this->generateNextQuestion($nextQuestionId, $this->getActualWhatsappNumber($data->From), $this->getActualWhatsappNumber($data->To));

        logger("chatbot next question \n" . $nextQuestion);

        $this->sendMessageReply($data->From, $nextQuestion, $nextQuestionId);
    }

    /**
     * @param int $nextQuestionId
     * @param string $from
     * 
     * @return string
     */
    private function generateNextQuestion(int $nextQuestionId, string $from, string $to = NULL): string
    {

        $nextQuestion = Question::find($nextQuestionId);

        $userName = ""; //get user name

        if ($nextQuestionId == Constants::REGISTERED_USER_START_QUESTION_ID) {

            //the variable there is the name
            $client = $this->getClient($to, $from);

            if ($client) {
                $userName = $client->lastname . " " . $client->firstname . " " . $client->othernames;
            }
        }

        $str = str_replace("\$name", $userName, $nextQuestion->question) . "\n\n" . $nextQuestion->options;

        return  $str;
    }
}
