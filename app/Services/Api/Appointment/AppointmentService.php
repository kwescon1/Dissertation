<?php

namespace App\Services\Api\Appointment;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Services\Api\CoreService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Jobs\ChangeAppointmentStatus;
use App\Models\Enums\AppointmentStatus;
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


    /**
     * @return void
     */
    public function changeAppointmentStatusToNoShow(): void
    {

        $date = Carbon::today();

        Appointment::where(function ($query) use ($date) {
            $query->whereDate('scheduled_at', $date)
                ->orWhereDate('scheduled_at', '<', $date);
        })->whereStatus(AppointmentStatus::SCHEDULED)->each(function ($appointment) {
            dispatch(new ChangeAppointmentStatus($appointment, AppointmentStatus::NO_SHOW));
        });
    }
}
