<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory, GeneratesUiud;

    protected $tableName = 'permissions';
    protected $keyType = "string";
    protected $guarded = ['id'];
}
