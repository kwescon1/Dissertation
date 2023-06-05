<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, GeneratesUiud, SoftDeletes;

    protected $table = 'clients';
    protected $keyType = "string";
    protected $guarded = ['id'];

    protected $dates = ['date_of_birth'];

    public function residence(): BelongsTo
    {
        return $this->belongsTo(Residence::class, 'residential_address_id');
    }

    public function emergencyContact(): BelongsTo
    {
        return $this->belongsTo(EmergencyContact::class, 'emergency_contact_id');
    }

    public function facilityId(): BelongsTo
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }


    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'client_id')->orderBy('scheduled_at', 'DESC');
    }
}
