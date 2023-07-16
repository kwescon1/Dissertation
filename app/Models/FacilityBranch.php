<?php

namespace App\Models;

use App\Observers\FacilityBranchObserver;
use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FacilityBranch extends Model
{
    use HasFactory, GeneratesUiud, SoftDeletes;

    protected $table = 'facility_branches';
    protected $keyType = "string";
    protected $guarded = ['id'];

    //observe facility branch model
    protected static function booted()
    {
        self::observe(FacilityBranchObserver::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_facility_branches', 'facility_branch_id', 'user_id');
    }
}
