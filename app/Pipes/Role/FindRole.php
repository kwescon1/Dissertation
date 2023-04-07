<?php

namespace App\Pipes\Role;

use Closure;
use App\Pipes\Pipe;
use App\Models\Role;
use App\Services\Api\CoreService;
use Illuminate\Support\Facades\Log;

class FindRole implements Pipe
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

        $role = Role::whereId($content['id'])->whereFacilityBranchId($content['facility_branch_id'])->first();

        if (!$role) {
            Log::error("Role with id: " . $content['id'] . " does not exist in branch with id: " . $content['facility_branch_id']);

            $this->coreService->throwNotFoundException("Role", $content['id']);
        }
        $content['role'] = $role;
        return $next($content);
    }
}
