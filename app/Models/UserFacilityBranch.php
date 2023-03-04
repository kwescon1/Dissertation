<?php

namespace App\Models;

use App\Utils\BaseModel;
use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserFacilityBranch extends BaseModel
{
    use HasFactory, GeneratesUiud, SoftDeletes;

    protected $table = 'user_facility_branches';
}
