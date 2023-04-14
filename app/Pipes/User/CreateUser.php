<?php

namespace App\Pipes\User;

use Closure;
use App\Pipes\Pipe;
use App\Models\User;
use App\Services\Api\CoreService;
use App\Models\UserFacilityBranch;
use App\Services\Api\User\UserServiceInterface;

class CreateUser implements Pipe
{

    private $coreService, $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->coreService = new CoreService;
        $this->userService = $userService;
    }

    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe

        $content['password'] = $this->coreService->hashUserPassword($content['password']);

        $content['status'] = $this->userService::STATUS_PENDING;

        $content['username'] = strtolower($content['username']);

        $role = $content['role'];
        $facilityBranchId = $content['facility_branch_id'];

        $user = User::create($this->removeData($content));

        //create facility branch userDetails
        $userFacilityBranch = UserFacilityBranch::create([
            'user_id' => $user->id,
            'facility_id' => $user->facility_id,
            'facility_branch_id' => $facilityBranchId,
        ]);

        $userFacilityBranch->assignRole($role);

        return $next($user);
    }

    private function removeData($content)
    {
        unset($content['role'], $content['facility_branch_id']);

        return $content;
    }
}
