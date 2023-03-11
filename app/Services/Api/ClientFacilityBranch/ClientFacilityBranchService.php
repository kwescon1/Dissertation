<?php

namespace App\Services\Api\ClientFacilityBranch;

use App\Services\Api\CoreService;
use App\Exceptions\ValidationException;
use App\Models\ClientFacilityBranch;

class ClientFacilityBranchService extends CoreService implements ClientFacilityBranchServiceInterface
{

    public function __construct()
    {
    }

    public function createClientFacilityBranch(array $data): void
    {


        $clientExists = $this->clientExistsForBranch(
            $data["client_id"],
            $data["facility_id"],
            $data["facility_branch_id"]
        );

        if ($clientExists) {
            throw new ValidationException("Client already exists in facility branch");
        }

        ClientFacilityBranch::create($data);
    }


    private function clientExistsForBranch($clientId, $facilityId, $facilityBranchId): bool
    {
        return ClientFacilityBranch::where("client_id", $clientId)->where("facility_id", $facilityId)->where("facility_branch_id", $facilityBranchId)->exists();
    }
}
