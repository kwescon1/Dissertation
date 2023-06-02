<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OpenAiException extends Exception
{
    //

    public function __construct($message)
    {
        parent::__construct($message);
    }

    public function render(Request $e)
    {
        Log::error($this->message);
    }
}
