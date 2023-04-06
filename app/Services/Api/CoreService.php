<?php

namespace App\Services\Api;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;
use Illuminate\Support\Facades\Log;

class CoreService implements CoreServiceInterface
{

    /**
     * @param string $resource(the specified resource)
     * @param string $id(the id of the specified resource)
     */
    public function throwNotFoundException($resource, $id)
    {
        Log::error("$resource with id: $id does not exist in this facility branch");

        throw new NotFoundException("The specified strtolower($resource) does not exist");
    }

    /**
     * @param string $message
     */
    public function throwForbiddenException($message)
    {
        throw new ForbiddenException($message);
    }

    /**
     * @param string $message
     */
    public function throwValidationException($message)
    {
        throw new ValidationException($message);
    }
}
