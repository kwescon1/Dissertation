<?php

namespace App\Services\Api\Facility;

use App\Models\Facility;
use App\Services\Api\CoreService;
use App\Services\Api\Facility\FacilityServiceInterface;

class FacilityService extends CoreService implements FacilityServiceInterface
{

    public function getFacility(string $facilityId): ?object
    {
        return Facility::whereId($facilityId)->first();
    }
}
