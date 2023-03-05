<?php

namespace App\Services\Api\FacilityBranch;

use App\Models\FacilityBranch;
use App\Services\Api\CoreService;
use App\Services\Api\FacilityBranch\FacilityBranchServiceInterface;

class FacilityBranchService extends CoreService implements FacilityBranchServiceInterface
{

    public function getFacilityBranch(string $facilityBranchId): ?object
    {
        return FacilityBranch::whereId($facilityBranchId)->first();
    }
}
