<?php

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
                "name" => "edit-clients",
                "description" => "Can add, edit or view clients",
                "guard_name" => "api"
            ],
            [
                "label" => "View Clients",
                "name" => "view-clients",
                "description" => "Can only view clients",
                "guard_name" => "api"
            ],
            [
                "label" => "Delete Clients",
                "name" => "delete-clients",
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
        $permissions = ['edit-clients', 'view-clients', 'delete-clients'];

        Permission::whereIn('name', $permissions)->delete();
    }
}
