<?php

namespace App\Providers;

use App\Services\Whatsapp\Whatsapp;
use Illuminate\Support\ServiceProvider;

class WhatsAappServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Whatsapp::class, function ($app) {
            return new Whatsapp(config('twilio.twilio_sid'), config('twilio.twilio_auth_token'), config('twilio.twilio_number'), $twilio = null);
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
