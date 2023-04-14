<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\SerializableClosure\Exceptions\InvalidSignatureException;

class InvalidLinkException extends InvalidSignatureException
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
