<?php

namespace App\Services\Api\Appointment;

use Illuminate\Database\Eloquent\Collection;

interface AppointmentServiceInterface
{

    public function appointments(string $facilityBranchId, ?string $date): ?Collection;

    public function changeAppointmentStatusToNoShow(): void;
}
