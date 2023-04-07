<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, GeneratesUiud;

    protected $table = 'users';
    protected $keyType = "string";
    protected $guarded = ['id'];
    protected $dateTimes = [
        'current_login_at', 'last_login_at'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

    /**
     * user belongs to many facility branches
     */
    public function facilityBranches(): BelongsToMany
    {
        return $this->belongsToMany(FacilityBranch::class, 'user_facility_branches', 'user_id', 'facility_branch_id')
            ->as('facility_branch')->withPivot('last_login_at')->orderBy('name', 'ASC');
    }
    /**
     * return current logged in branch
     */
    public function loggedInBranch()
    {
        /**
         * the updated at field is always updated whenever a user logs in. so it is assumed that where the updated at field is current and the current login field is not null is the latest branch the user has logged into
         */
        return $this->hasOne(UserFacilityBranch::class, 'user_id')->latest('updated_at')->where('current_login_at', '!=', Null);
    }
}
