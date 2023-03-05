<?php

namespace App\Services\Api\FacilityBranch;

interface FacilityBranchServiceInterface
{

    public function getFacilityBranch(string $facilityBranchId): ?object;
}
