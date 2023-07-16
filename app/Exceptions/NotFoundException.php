<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotFoundException extends \Exception
{

	public function __construct($message)
	{
		parent::__construct($message);
	}
	public function render(Request $e)
	{
		return response()->notfound($this->message);
	}
}
