<?php

namespace App\Services\Api\FacilityBranch;

interface FacilityBranchServiceInterface
{

    public function getFacilityBranch(string $facilityId, string $facilityBranchId): ?object;

    public function facilityBranchExists(string $facilityId, string $facilityBranchId): ?bool;
}
