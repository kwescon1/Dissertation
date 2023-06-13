<?php

namespace App\Models;

use Carbon\Carbon;
use App\Utils\GeneratesUiud;
use App\Models\Enums\AppointmentType;
use App\Models\Enums\AppointmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    protected $table = 'appointments';
    protected $keyType = "string";
    protected $guarded = ['id'];

    protected $casts = ['type' => AppointmentType::class, 'status' => AppointmentStatus::class];

    protected $dates = ['scheduled_at'];

    use HasFactory, GeneratesUiud, SoftDeletes;

    public function getAppointmentDetails(): string
    {
        $status = $this->status->resolveDisplayableValue();
        $type = $this->type->resolveDisplayableValue();
        $date = Carbon::parse($this->scheduled_at)->toDateString();
        $time = Carbon::parse($this->scheduled_at)->format('h:ia');

        $message = "Appointment Details📝:\n\n";
        $message .= "Status🔵: $status\n";
        $message .= "Type🗂️: $type\n";
        $message .= "Date📆: $date\n";
        $message .= "Time⏳: $time\n";

        return $message;
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function scopeScheduledDate($query, $date)
    {
        return $query->whereDate('scheduled_at', $date);
    }

    public function scopeStatus($query, $status)
    {
        return $query->whereStatus($status);
    }

    public function scopeBranch($query, $branch)
    {
        return $query->whereFacilityBranchId($branch);
    }
}
