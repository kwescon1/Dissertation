<?php

namespace App\Pipes\User;

use Closure;
use App\Pipes\Pipe;
use App\Services\Api\CoreService;
use App\Models\UserFacilityBranch;
use App\Services\Api\User\UserServiceInterface;

class FindUserFacilityBranch implements Pipe
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

        $userFacilityBranch = UserFacilityBranch::whereUserId($content['user']->id)->whereFacilityId($content['facility_id'])
            ->whereFacilityBranchId($content['facility_branch_id'])->first();

        if (!$userFacilityBranch) {
            $this->coreService->throwNotFoundException('User Branch Account', $content['id']);
        }

        $content['user_branch'] = $userFacilityBranch;

        return $next($content);
    }
}
