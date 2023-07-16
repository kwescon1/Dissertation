<?php

namespace App\Models;

use App\Observers\OpenAiMessageTrackerObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenAiMessageTracker extends Model
{
    use HasFactory;

    const CACHE_KEY = 'timer';
    const CACHE_SECONDS = 60 * 60 * 24;

    protected $fillable = ['from','message_time'];

    //observe model
    protected static function booted()
    {
        self::observe(OpenAiMessageTrackerObserver::class);
    }
}
