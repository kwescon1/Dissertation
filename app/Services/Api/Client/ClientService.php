<?php

namespace App\Services\Api\Client;

use App\Models\Client;

use App\Services\Api\CoreService;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use App\Pipes\Client\StoreResidence;
use App\Exceptions\NotFoundException;
use App\Pipes\Client\RemoveResidence;
use App\Pipes\Client\GenerateNhsNumber;
use App\Pipes\Client\StoreEmergencyContact;
use App\Pipes\Client\RemoveEmergencyContact;
use App\Services\Api\Client\ClientServiceInterface;
use App\Services\Api\Facility\FacilityServiceInterface;
use App\Services\Api\ClientFacilityBranch\ClientFacilityBranchServiceInterface;

class ClientService extends CoreService implements ClientServiceInterface
{

    private $facilityService;
    private $clientFacilityBranchService;

    public function __construct(FacilityServiceInterface $facilityService, ClientFacilityBranchServiceInterface $clientFacilityBranchService)
    {
        $this->facilityService = $facilityService;

        $this->clientFacilityBranchService = $clientFacilityBranchService;;
    }

    public function storeClient(array $data)
    {

        //check if facility exists
        $facilityExists = $this->facilityService->facilityExists($data['facility_id']);

        if (!$facilityExists) {
            throw new NotFoundException("Facility not found");
        }



        $pipes = [StoreResidence::class, RemoveResidence::class, StoreEmergencyContact::class, RemoveEmergencyContact::class, GenerateNhsNumber::class];


        return DB::transaction(function () use ($pipes, $data) {

            return app(Pipeline::class)->send($data)->through($pipes)->then(function ($content) {

                $facilityBranchId = $content['facility_branch_id'];

                unset($content['facility_branch_id']);
                $client = $this->saveClient($content);

                $this->clientFacilityBranchService->createClientFacilityBranch([
                    'client_id' => $client->id,
                    'facility_id' => $client->facility_id,
                    'facility_branch_id' => $facilityBranchId
                ]);
                return $client;
            });
        });
    }

    private function saveClient(array $data)
    {

        return Client::create($data);
    }
}
