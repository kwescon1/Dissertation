<?php

namespace App\Pipes\Role;

use Closure;
use App\Pipes\Pipe;
use App\Models\Role;
use App\Services\Api\CoreService;

class VerifyRoleNameForUpdate implements Pipe
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


        $role = Role::whereName($content['name'])->whereFacilityBranchId($content['facility_branch_id'])->first();

        if ($role && $content['role']->name !== $role->name) {
            $this->coreService->throwValidationException("Role Exists Already In Facility Branch");
        }

        return $next($content);
    }
}
