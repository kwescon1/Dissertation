<?php

use App\Models\Permission;
use App\Services\Api\Constants\Permissions;
use Illuminate\Database\Migrations\Migration;

class AddClientPermissionsToPermissionsTable extends Migration
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
                "label" => "Edit Clients",
                "name" => Permissions::EDIT_CLIENT,
                "description" => "Can add, edit or view clients",
                "guard_name" => "api"
            ],
            [
                "label" => "View Clients",
                "name" => Permissions::VIEW_CLIENT,
                "description" => "Can only view clients",
                "guard_name" => "api"
            ],
            [
                "label" => "Delete Clients",
                "name" => Permissions::DELETE_CLIENT,
                "description" => "Can delete clients",
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
        $permissions = [Permissions::EDIT_CLIENT, Permissions::VIEW_CLIENT, Permissions::DELETE_CLIENT];

        Permission::whereIn('name', $permissions)->delete();
    }
}
