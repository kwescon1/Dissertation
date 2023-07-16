<?php

namespace App\Services\Api\FacilityBranch;

use App\Models\FacilityBranch;
use App\Services\Api\CoreService;
use App\Services\Api\FacilityBranch\FacilityBranchServiceInterface;

class FacilityBranchService extends CoreService implements FacilityBranchServiceInterface
{

    public function getFacilityBranch(string $facilityId, string $facilityBranchId): ?object
    {
        return FacilityBranch::whereId($facilityBranchId)->whereFacilityId($facilityId)->first();
    }

    public function facilityBranchExists(string $facilityId, string $facilityBranchId): ?bool
    {
        return FacilityBranch::whereId($facilityBranchId)->whereFacilityId($facilityId)->first();
    }
}
