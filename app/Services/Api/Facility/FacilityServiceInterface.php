<?php

namespace App\Services\Api\Facility;

interface FacilityServiceInterface
{
    public function getFacility(string $facilityId): ?object;

    public function facilityExists(string $facilityId): bool;
}
