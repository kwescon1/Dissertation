<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFacilityBranch extends Model
{
    use HasFactory, GeneratesUiud, SoftDeletes, HasRoles;

    protected $table = 'user_facility_branches';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
