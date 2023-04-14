<?php

namespace App\Pipes\User;

use Closure;
use App\Pipes\Pipe;
use App\Models\Role;
use App\Services\Api\CoreService;

class VerifyRoleExistsInFacilityBranch implements Pipe
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

        $role = Role::whereFacilityBranchId($content['facility_branch_id'])->whereId($content['role'])->first();

        if (!$role) {
            $this->coreService->throwNotFoundException('Role', $content['role']);
        }

        $content['role'] = $role;

        return $next($content);
    }
}
