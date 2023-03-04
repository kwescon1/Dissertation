<?php

namespace App\Services\Api\UserFacilityBranch;

interface UserFacilityBranchServiceInterface
{
    public function getUserBranch(string $userId, string $facilityId, string $facilityBranchId = NULL): ?object;
}
