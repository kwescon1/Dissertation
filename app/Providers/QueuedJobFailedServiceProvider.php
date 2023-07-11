<?php

namespace App\Providers;

use App\Mail\JobFailedMailable;
use Carbon\Carbon;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class QueuedJobFailedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Queue::failing(function (JobFailed $event) {
            logger("sending email for failed job");

            Mail::to(config('mail.notif_email'))->send(new JobFailedMailable($event));
        });
    }
}
