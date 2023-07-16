<?php

use App\Models\Permission;
use App\Services\Api\Constants\Permissions;
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
                "name" => Permissions::EDIT_APPOINTMENT,
                "description" => "Can add, edit or view appointments",
                "guard_name" => "api"
            ],
            [
                "label" => "View Appointments",
                "name" => Permissions::VIEW_APPOINTMENT,
                "description" => "Can only view appointments",
                "guard_name" => "api"
            ],
            [
                "label" => "Delete Appointments",
                "name" => Permissions::DELETE_APPOINTMENT,
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

        $permissions = [Permissions::EDIT_APPOINTMENT, Permissions::VIEW_APPOINTMENT, Permissions::DELETE_APPOINTMENT];

        Permission::whereIn('name', $permissions)->delete();
    }
}
