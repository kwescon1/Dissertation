<?php

namespace App\Models;

use App\Utils\BaseModel;
use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Residence extends BaseModel
{
    use HasFactory, SoftDeletes, GeneratesUiud;

    protected $table = 'residences';

    public function client()
    {
        return $this->belongsTo(Client::class, 'residential_address_id');
    }
}
