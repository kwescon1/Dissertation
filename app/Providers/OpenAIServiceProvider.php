<?php

namespace App\Providers;

use App\Services\OpenAI\OpenAI as Chat;
use Illuminate\Support\ServiceProvider;

class OpenAIServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Chat::class, function ($app) {
            return new Chat(config('openai.open_ai_key'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
