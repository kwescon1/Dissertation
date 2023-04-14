<?php

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppointmentPermissionsToPermissionsTable extends Migration
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
                "label" => "Edit Appointments",
                "name" => "edit-appointments",
                "description" => "Can add, edit or view appointments",
                "guard_name" => "api"
            ],
            [
                "label" => "View Appointments",
                "name" => "view-appointments",
                "description" => "Can only view appointments",
                "guard_name" => "api"
            ],
            [
                "label" => "Delete Appointments",
                "name" => "delete-appointments",
                "description" => "Can delete appointments",
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
        $permissions = ['edit-appointments', 'view-appointments', 'delete-appointments'];

        Permission::whereIn('name', $permissions)->delete();
    }
}
