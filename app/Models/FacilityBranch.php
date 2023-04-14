<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacilityBranch extends Model
{
    use HasFactory, GeneratesUiud, SoftDeletes;

    protected $table = 'facility_branches';
    protected $keyType = "string";
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_facility_branches', 'facility_branch_id', 'user_id');
    }
}
