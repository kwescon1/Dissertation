<?php

use App\Models\Permission;
use App\Services\Api\Constants\Permissions;
use Illuminate\Database\Migrations\Migration;

class AddRolePermissionsToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            [
                "label" => "Edit Roles",
                "name" => Permissions::EDIT_ROLE,
                "description" => "Can add, edit or view roles",
                "guard_name" => "api"
            ],
            [
                "label" => "View Roles",
                "name" => Permissions::VIEW_ROLE,
                "description" => "Can only view roles",
                "guard_name" => "api"
            ],
            [
                "label" => "Delete Roles",
                "name" => Permissions::DELETE_ROLE,
                "description" => "Can delete roles",
                "guard_name" => "api"
            ],
        ];

        Permission::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $permissions = [Permissions::EDIT_ROLE, Permissions::VIEW_ROLE, Permissions::DELETE_ROLE];

        Permission::whereIn('name', $permissions)->delete();
    }
}
