<?php

namespace App\Services\Api\UserFacilityBranch;

use App\Services\Api\CoreService;
use App\Models\UserFacilityBranch;
use App\Services\Api\UserFacilityBranch\UserFacilityBranchServiceInterface;

class UserFacilityBranchService extends CoreService implements UserFacilityBranchServiceInterface
{
    public function getUserBranch(string $userId, string $facilityId, string $facilityBranchId = NULL): ?object
    {
        return isset($facilityBranchId) ? UserFacilityBranch::whereUserId($userId)->whereFacilityId($facilityId)->whereFacilityBranchId($facilityBranchId)->with('roles:id,name', 'roles.permissions:id,name')->first() : UserFacilityBranch::whereUserId($userId)->whereFacilityId($facilityId)->with('roles:id,name', 'roles.permissions:id,name')->latest('last_login_at')->first();
    }
}
