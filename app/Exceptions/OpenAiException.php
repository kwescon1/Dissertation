<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class OpenAiException extends Exception
{
    //

    public function __construct($message, $code = Response::HTTP_FORBIDDEN)
    {
        parent::__construct($message, $code);
    }

    public function render(Request $e)
    {
        return response()->error($this->message, $this->code);
    }
}
