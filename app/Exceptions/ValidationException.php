<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValidationException extends \Exception
{

	public function __construct($message, $code = Response::HTTP_BAD_REQUEST)
	{
		parent::__construct($message, $code);
	}
	public function render(Request $e)
	{
		return response()->error($this->message, $this->code);
	}
}
