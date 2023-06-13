<?php

namespace App\Services\Api\Appointment;

use App\Models\Appointment;
use App\Services\Api\CoreService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Collection;

class AppointmentService extends CoreService implements AppointmentServiceInterface
{

    public function appointments(string $facilityBranchId, ?string $date): ?Collection
    {

        Gate::authorize('viewAny', Appointment::class);

        if (!$date) {
            $this->throwInvalidException("Invalid Date Argument");
        }

        return Appointment::branch($facilityBranchId)->scheduledDate($date)->with('client:id,firstname,lastname,othernames')->get();
    }
}
