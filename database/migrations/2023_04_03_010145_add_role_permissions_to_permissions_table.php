<?php

use App\Models\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
                "name" => "edit-roles",
                "description" => "Can add, edit or view roles",
                "guard_name" => "api"
            ],
            [
                "label" => "View Roles",
                "name" => "view-roles",
                "description" => "Can only view roles",
                "guard_name" => "api"
            ],
            [
                "label" => "Delete Roles",
                "name" => "delete-roles",
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
        $permissions = ['edit-roles', 'view-roles', 'delete-roles'];

        Permission::whereIn('name', $permissions)->delete();
    }
}
