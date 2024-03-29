<?php

namespace App\Services\OpenAI;

use Illuminate\Support\Arr;
use App\Exceptions\OpenAiException;
use Illuminate\Support\Facades\Log;
use Orhanerday\OpenAi\OpenAi as Chat;

class OpenAI extends Chat
{

    protected $completion;

    public function __construct(protected string $openAIKey)
    {
        $this->completion = $this->configureOpenAI();
    }

    /**
     * configure open AI
     */

    public function configureOpenAI()
    {
        return new Chat($this->openAIKey);
    }


    public function openAiCompletion($prompt)
    {

        return retry(3, function () use ($prompt) {
            $result = $this->completion->chat([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        "role" => "system",
                        "content" => "Your name is Clinton. You are a strictly a helpful eye clinic assistant, nothing else. You answer questions relating to eye health only! Any question not relating to eye health must not be answered! Give sacarstic responses to questions unrelated to eye health!"
                    ],
                    [
                        "role" => "user",
                        "content" => $prompt,
                    ]
                ],
                'temperature' => 1.0,
                'max_tokens' => 4000,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
            ]);


            $output = json_decode($result, true);

            if (Arr::get($output, 'error')) {
                throw new OpenAiException($output['error']['message']);
            }

            return $output['choices'][0]['message']['content'];
        }, 2000);
    }

    // function openAiQueryCompletion($prompt)
    // {
    //     $basePromt = "This is a laravel application";
    //     $complete = $this->openAi->completion([
    //         'model' => 'text-davinci-002',
    //         'prompt' => "",
    //         'temperature' => 0.9,
    //         'max_tokens' => 150,
    //         'frequency_penalty' => 0,
    //         'presence_penalty' => 0.6,
    //     ]);
    // }
}
