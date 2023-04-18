<?php

use App\Models\Permission;
use App\Services\Api\Constants\Permissions;
use Illuminate\Database\Migrations\Migration;

class AddUserPermissionsToPermissionsTable extends Migration
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
                "label" => "Edit Users",
                "name" => Permissions::EDIT_USER,
                "description" => "Can add, edit or view users",
                "guard_name" => "api"
            ],
            [
                "label" => "View Users",
                "name" => Permissions::VIEW_USER,
                "description" => "Can only view users",
                "guard_name" => "api"
            ],
            [
                "label" => "Delete Users",
                "name" => Permissions::DELETE_USER,
                "description" => "Can delete users",
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
        $permissions = [Permissions::EDIT_USER, Permissions::VIEW_USER, Permissions::DELETE_USER];

        Permission::whereIn('name', $permissions)->delete();
    }
}
