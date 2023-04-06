<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Spatie\Permission\Guard;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends SpatieRole
{

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? 'api';

        parent::__construct($attributes);
    }

    use HasFactory, GeneratesUiud, SoftDeletes;

    protected $tableName = 'roles';
    protected $keyType = "string";
    protected $guarded = ['id'];



    /**
     * override default create method from spatie.
     * add facility_branch_id to $params array
     * original create method does not have the facility_branch_id hence RoleAreadyExists error is thrown
     * */
    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

        $params = [
            'name' => $attributes['name'], 'guard_name' => $attributes['guard_name'],
            'facility_branch_id' => $attributes['facility_branch_id']
        ];

        if (static::findByParam($params)) {
            throw RoleAlreadyExists::create($attributes['name'], $attributes['guard_name']);
        }

        return static::query()->create($attributes);
    }

    /**
     * A role belongs to some users of the model associated with its guard.
     */
    public function users(): BelongsToMany
    {

        return $this->morphedByMany(
            UserFacilityBranch::class,
            'model',
            config('permission.table_names.model_has_roles'),
            PermissionRegistrar::$pivotRole,
            config('permission.column_names.model_morph_key')
        );
    }
}
