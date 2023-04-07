<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserFacilityBranch extends Model
{
    use HasFactory, GeneratesUiud, SoftDeletes, HasRoles;

    protected $table = 'user_facility_branches';
    protected $keyType = "string";
    protected $guarded = ['id'];
    protected $guard_name = 'api';
    protected $dates = ['current_login_at', 'last_login_at'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * A model may have multiple roles.
     */
    public function roles(): BelongsToMany
    {
        return $this->morphToMany(
            Role::class,
            'model',
            config('permission.table_names.model_has_roles'),
            config('permission.column_names.model_morph_key'),
            'role_id'
        );
    }
}
