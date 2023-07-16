<?php

namespace App\Observers;

use Illuminate\Support\Facades\Log;
use App\Models\OpenAiMessageTracker;
use Illuminate\Support\Facades\Cache;

class OpenAiMessageTrackerObserver
{
    /**
     * Handle the OpenAiMessageTracker "created" event.
     *
     * @param  \App\Models\OpenAiMessageTracker  $openAiMessageTracker
     * @return void
     */
    public function created(OpenAiMessageTracker $openAiMessageTracker)
    {
        $openAiMessageTracker::CACHE_KEY;

        if (!Cache::has($openAiMessageTracker::CACHE_KEY)) {
            
            $this->cacheData($openAiMessageTracker::CACHE_KEY, $openAiMessageTracker::CACHE_SECONDS);

        } else {

            Cache::forget($openAiMessageTracker::CACHE_KEY);

            $this->cacheData($openAiMessageTracker::CACHE_KEY, $openAiMessageTracker::CACHE_SECONDS);

        }
    }

    /**
     * Handle the OpenAiMessageTracker "updated" event.
     *
     * @param  \App\Models\OpenAiMessageTracker  $openAiMessageTracker
     * @return void
     */
    public function updated(OpenAiMessageTracker $openAiMessageTracker)
    {

        if (Cache::has($openAiMessageTracker::CACHE_KEY)) {
            Cache::forget($openAiMessageTracker::CACHE_KEY);

            $this->cacheData($openAiMessageTracker::CACHE_KEY, $openAiMessageTracker::CACHE_SECONDS);
        } else {
            $this->cacheData($openAiMessageTracker::CACHE_KEY, $openAiMessageTracker::CACHE_SECONDS);
        }
    }

    /**
     * Handle the OpenAiMessageTracker "deleted" event.
     *
     * @param  \App\Models\OpenAiMessageTracker  $openAiMessageTracker
     * @return void
     */
    public function deleted(OpenAiMessageTracker $openAiMessageTracker)
    {
        if (Cache::has($openAiMessageTracker::CACHE_KEY)) {
            Cache::forget($openAiMessageTracker::CACHE_KEY);

            $this->cacheData($openAiMessageTracker::CACHE_KEY, $openAiMessageTracker::CACHE_SECONDS);
        } else {
            $this->cacheData($openAiMessageTracker::CACHE_KEY, $openAiMessageTracker::CACHE_SECONDS);
        }
    }

    /**
     * Handle the OpenAiMessageTracker "restored" event.
     *
     * @param  \App\Models\OpenAiMessageTracker  $openAiMessageTracker
     * @return void
     */
    public function restored(OpenAiMessageTracker $openAiMessageTracker)
    {
        //
    }

    /**
     * Handle the OpenAiMessageTracker "force deleted" event.
     *
     * @param  \App\Models\OpenAiMessageTracker  $openAiMessageTracker
     * @return void
     */
    public function forceDeleted(OpenAiMessageTracker $openAiMessageTracker)
    {
        //
    }

    private function cacheData($cacheKey, $cacheSeconds)
    {
        $data = [];

        return OpenAiMessageTracker::chunk(1000, function ($timings) use ($data, $cacheKey, $cacheSeconds) {
            foreach ($timings as $timing) {
                array_push($data, $timing);
            }

            return Cache::remember($cacheKey, $cacheSeconds, function () use ($data) {
                return collect($data);
            });
        });
    }
}
