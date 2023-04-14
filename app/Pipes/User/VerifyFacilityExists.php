<?php

namespace App\Pipes\User;

use Closure;
use App\Pipes\Pipe;
use App\Models\Facility;
use App\Models\FacilityBranch;
use App\Services\Api\CoreService;

class VerifyFacilityExists implements Pipe
{

    private $coreService;

    public function __construct()
    {
        $this->coreService = new CoreService;
    }

    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe

        $facility = Facility::whereId($content['facility_id'])->exists();

        if (!$facility) {
            $this->coreService->throwNotFoundException('Facility', $content['facility_id']);
        }

        $facilityBranch = FacilityBranch::whereId($content['facility_branch_id'])->whereFacilityId($content['facility_id'])->exists();

        if (!$facilityBranch) {
            $this->coreService->throwNotFoundException('Facility Branch', $content['facility_branch_id']);
        }

        return $next($content);
    }
}
