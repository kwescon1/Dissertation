<?php

namespace App\Pipes\Client;

use Closure;
use App\Pipes\Pipe;
use App\Models\Client;
use App\Models\Facility;
use App\Models\FacilityBranch;
use App\Utils\ClientNumberUtils;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Cache;
use App\Services\Api\Facility\FacilityServiceInterface;

class GenerateNhsNumber implements Pipe
{
    private $facilityService;

    public function __construct(FacilityServiceInterface $facilityService)
    {

        $this->facilityService = $facilityService;
    }

    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe

        $facility =  $this->facility($content['facility_id']);

        $facilityBranch = $this->facilityBranch($facility->id, str_replace("whatsapp:", "", config('twilio.twilio_number')));

        $content['nhs_number'] = $this->generateNhsNumber($facility, $facilityBranch);

        $content['facility_branch_id'] = $facilityBranch->id;

        return $next($content);
    }

    private function facility(string $facilityId): ?object
    {
        $facility = $this->facilityService->getFacility($facilityId);

        if (!$facility) {
            throw new NotFoundException('Facility Not Found');
        }

        return $facility;
    }



    private function facilityBranch(string $facilityId, string $phoneNumber): ?object
    {
        $facilityBranch = FacilityBranch::whereFacilityId($facilityId)->wherePhone($phoneNumber)->first();

        if (!$facilityBranch) {
            throw new NotFoundException('Facility Brancn Not Found');
        }

        return $facilityBranch;
    }


    private function generateNhsNumber(Facility $facility, FacilityBranch $facilityBranch): string
    {

        $latestUniqueNumber = $this->latestUniqueNumber($facility->id, $facilityBranch->id);

        $clientNumber = ClientNumberUtils::generate($facility->code, $facilityBranch->code, $latestUniqueNumber);

        while ($this->verifyClientNumber($clientNumber, $facility->id, $facilityBranch->id)) {
            $this->resetCachedUniqueClientNumber($facilityBranch->id, $clientNumber);
            $clientNumber = ClientNumberUtils::generate($facility->code, $facilityBranch->code, ClientNumberUtils::extractUniqueClientNumber($clientNumber));
        }

        return $clientNumber;
    }

    private static function resetCachedUniqueClientNumber_s($facilityBranchId, $clientNumber)
    {
        Cache::put(self::CACHE_KEY_UNIQUE_CLIENT_NUMBER . $facilityBranchId, ClientNumberUtils::extractUniqueClientNumber($clientNumber));
    }

    private function resetCachedUniqueClientNumber($facilityBranchId, $clientNumber)
    {
        self::resetCachedUniqueClientNumber_s($facilityBranchId, $clientNumber);
    }


    /**
     * @param $facilityBranchId
     * @param $facilityId
     *
     * @return object|string
     */
    private function latestUniqueNumber($facilityId, $facilityBranchId)
    {
        return Cache::remember(self::CACHE_KEY_UNIQUE_CLIENT_NUMBER . $facilityBranchId, self::CACHE_SECONDS, function () use ($facilityId, $facilityBranchId) {
            $lastSavedClient = $this->lastSavedClient($facilityId, $facilityBranchId);

            return $lastSavedClient ? ClientNumberUtils::extractUniqueClientNumber($lastSavedClient->nhs_number) : 10001;
        });
    }

    private function verifyClientNumber(string $clientNumber, string $facilityId, string $facilityBranchId): ?bool
    {
        return Client::join('client_facility_branches', 'clients.id', '=', 'client_facility_branches.client_id')->where('clients.facility_id', $facilityId)->where('client_facility_branches.facility_branch_id', $facilityBranchId)->withTrashed()->where('clients.nhs_number', $clientNumber)->exists();
    }

    private function lastSavedClient(string $facilityId, string $facilityBranchId): ?object
    {
        return Client::join('client_facility_branches', 'clients.id', '=', 'client_facility_branches.client_id')->where('clients.facility_id', $facilityId)->where('client_facility_branches.facility_branch_id', $facilityBranchId)->withTrashed()->orderBy('clients.created_at', 'desc')->first();
    }
}
