<?php

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
                "name" => "edit-user",
                "description" => "Can add, edit or view users",
                "guard_name" => "api"
            ],
            [
                "label" => "View Users",
                "name" => "view-users",
                "description" => "Can only view users",
                "guard_name" => "api"
            ],
            [
                "label" => "Delete Users",
                "name" => "delete-users",
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
        $permissions = ['edit-users', 'view-users', 'delete-users'];

        Permission::whereIn('name', $permissions)->delete();
    }
}
