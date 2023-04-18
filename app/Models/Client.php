<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, GeneratesUiud, SoftDeletes;

    protected $table = 'clients';
    protected $keyType = "string";
    protected $guarded = ['id'];

    protected $dates = ['date_of_birth'];

    public function residence()
    {
        return $this->hasOne(Residence::class, 'residential_address_id');
    }

    public function emergencyContact()
    {
        return $this->hasOne(EmergencyContact::class, 'emergency_contact_id');
    }

    public function facilityId()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }
}
