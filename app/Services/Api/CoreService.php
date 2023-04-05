<?php

namespace App\Services\Api;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Log;

class CoreService implements CoreServiceInterface
{

    /**
     * @param string $resource(the specified resource)
     * @param string $id(the id of the specified resource)
     */
    protected function throwNotFoundException($resource, $id)
    {
        Log::error("$resource with id: $id does not exist in this facility branch");

        throw new NotFoundException("The specified strtolower($resource) does not exist");
    }

    /**
     * @param string $message
     */
    protected function throwForbiddenException($message)
    {
        throw new ForbiddenException($message);
    }
}
