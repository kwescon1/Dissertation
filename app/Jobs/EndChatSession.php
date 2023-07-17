<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use App\Models\OpenAiMessageTracker;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\Chatbot\OpenAiChatService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class EndChatSession implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     *
     */
    public function handle(OpenAiChatService $endSession)
    {

        OpenAiMessageTracker::chunk(1000, function ($timings) use($endSession){
            $timings->each(function($timing) use($endSession){
                if(Carbon::now()->diffInMinutes($timing->message_time) > 5){
                    $endSession->endOpenAiInactiveSession($timing->from);
    
                $timing->delete();
                }
            });
        });
    }
}
