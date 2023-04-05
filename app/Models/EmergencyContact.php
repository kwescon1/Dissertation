<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmergencyContact extends Model
{
    use HasFactory, SoftDeletes, GeneratesUiud;

    protected $table = 'emergency_contacts';
    protected $keyType = "string";
    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'emergency_contact_id');
    }
}
