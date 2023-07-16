<?php

namespace App\Pipes\User;

use Closure;
use App\Pipes\Pipe;
use App\Models\User;
use App\Services\Api\CoreService;

class VerifyUsernameExistsForFacility implements Pipe
{

    private $coreService;

    public function __construct()
    {
        $this->coreService = new CoreService;
    }

    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe

        if ($this->usernameExistsForFacility($content['facility_id'], $content['username'])) {
            $this->coreService->throwValidationException("An existing username for '{$content['username']}' was found. Username should be unique");
        }

        return $next($content);
    }


    private function usernameExistsForFacility($facilityId, $username): bool
    {
        return User::whereFacilityId($facilityId)->whereUsername($username)->exists();
    }
}
