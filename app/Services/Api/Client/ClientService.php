<?php

namespace App\Services\Api\Client;

use App\Models\Client;

use App\Models\Facility;
use App\Models\FacilityBranch;
use App\Services\Api\CoreService;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Pipes\Client\StoreResidence;
use App\Services\Chatbot\AppService;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\NotFoundException;
use App\Pipes\Client\RemoveResidence;
use App\Pipes\Client\GenerateNhsNumber;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidLinkException;
use App\Pipes\Client\StoreEmergencyContact;
use App\Pipes\Client\RemoveEmergencyContact;
use App\Services\Api\Client\ClientServiceInterface;
use App\Services\Api\Facility\FacilityServiceInterface;
use App\Services\Api\ClientFacilityBranch\ClientFacilityBranchServiceInterface;

class ClientService extends CoreService implements ClientServiceInterface
{

    private $facilityService;
    private $clientFacilityBranchService;
    private $appService;
    private const INVALID_URL = "Invalid Registration Link";

    public function __construct(FacilityServiceInterface $facilityService, ClientFacilityBranchServiceInterface $clientFacilityBranchService, AppService $appService)
    {
        $this->facilityService = $facilityService;

        $this->clientFacilityBranchService = $clientFacilityBranchService;;

        $this->appService = $appService;
    }

    public function storeClient(array $data): ?object
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

                $this->createClientFacilityBranch($client, $facilityBranchId);

                $this->successMessage($client->nhs_number, $client->phone);

                return $client;
            });
        });
    }

    /**
     * @param $request
     * @throws ValidationException
     */
    public function verifyRegistrationLink($request): array
    {

        $clientNumber = $request->route('client');
        $facilityId = $request->route('facilityId');

        $facility = Facility::whereId($facilityId)->first();

        $facilityBranchId = $request->route('branchId');

        $facilityBranch = FacilityBranch::whereId($facilityBranchId)->whereFacilityId($facilityId)->first();

        if (!$request->hasValidSignature() || !$facility || !$facilityBranch) {

            $number = $this->appService->replaceActualWhatsappNumber($clientNumber);

            $this->appService->sendReply($number, self::INVALID_URL);

            throw new InvalidLinkException(self::INVALID_URL);
        }

        return [
            "facility_id" => $facility->id,
            "facility_branch_id" => $facilityBranch->id,
            "phone" => $clientNumber
        ];
    }

    private function saveClient(array $data)
    {

        return Client::create($data);
    }

    private function createClientFacilityBranch($client, $facilityBranchId)
    {
        return $this->clientFacilityBranchService->createClientFacilityBranch([
            'client_id' => $client->id,
            'facility_id' => $client->facility_id,
            'facility_branch_id' => $facilityBranchId
        ]);
    }

    private function successMessage($nhsNumber, $clientPhone)
    {
        $str = "Thank you for registering for this service😊♥️\n\nPlease take note of the below..\n\nYour *🏥NHS  number is $nhsNumber*";
        $media = "thank_you.jpeg";

        $number = $this->appService->replaceActualWhatsappNumber($clientPhone);
        $this->appService->sendReply($number, $str, $media);

        return;
    }

    /**
     * @param string $facilityId
     * @param string $facilityBranchId
     * @return Collection|NULL
     */
    public function clients(string $facilityId, string $facilityBranchId): ?Collection
    {
        Gate::authorize('viewAny', Client::class);

        return Client::leftJoin('client_facility_branches', 'clients.id', '=', 'client_facility_branches.client_id')->where('clients.facility_id', $facilityId)->where('client_facility_branches.facility_branch_id', $facilityBranchId)->select('clients.*')->get();
    }

    /**
     * 
     * @param string $id
     * @param string $facilityId
     * @param string $facilityBranchId
     * @throws NotFoundException
     * 
     * Returns a specified resource
     */
    public function client(string $id, string $facilityId, string $facilityBranchId): ?Model
    {

        $client = $this->findClient($id, $facilityId, $facilityBranchId);

        if (!$client) {
            $this->throwNotFoundException('Client', $id);
        }

        Gate::authorize('view', $client);

        return $client;
    }

    /**
     * TODO update client
     */
    public function updateClient()
    {
    }

    /**
     * Deletes a specified client
     *
     * @param string $id
     * @param string $facilityId
     * @param string $facilityBranchId
     * 
     * @throws NotFoundException
     * @return bool
     */
    public function destroyClient($id, $facilityId, $facilityBranchId): ?bool
    {
        $client = $this->findClient($id, $facilityId, $facilityBranchId);

        if (!$client) {
            $this->throwNotFoundException('Client', $id);
        }

        Gate::authorize('delete', $client);

        return $client->delete();
    }

    private function findClient(string $id, $facilityId, $facilityBranchId)
    {
        return Client::leftJoin('client_facility_branches', 'clients.id', '=', 'client_facility_branches.client_id')->where('clients.facility_id', $facilityId)->where('client_facility_branches.facility_branch_id', $facilityBranchId)->where('clients.id', $id)->with('emergencyContact:id,emergency_contact_name,emergency_contact_phone', 'residence:id,first_address_line,second_address_line,third_address_line,town,county,postcode')->select('clients.*')->first();
    }
}
