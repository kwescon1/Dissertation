<?php

namespace App\Models;

use App\Utils\BaseModel;
use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacilityBranch extends BaseModel
{
    use HasFactory, GeneratesUiud, SoftDeletes;

    protected $table = 'facility_branches';
}
