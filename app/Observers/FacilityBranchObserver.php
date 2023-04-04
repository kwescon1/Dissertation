<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\FacilityBranch;

class FacilityBranchObserver
{
    /**
     * property definitions
     *
     */
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }
    /**
     * Handle the FacilityBranch "created" event.
     *
     * @param  \App\Models\FacilityBranch  $facilityBranch
     * @return void
     */
    public function created(FacilityBranch $facilityBranch)
    {
        //create default role and related permissions
        echo "Adding default role";
        $this->createDefaultRole($facilityBranch->id);
    }

    /**
     * Handle the FacilityBranch "updated" event.
     *
     * @param  \App\Models\FacilityBranch  $facilityBranch
     * @return void
     */
    public function updated(FacilityBranch $facilityBranch)
    {
        //
    }

    /**
     * Handle the FacilityBranch "deleted" event.
     *
     * @param  \App\Models\FacilityBranch  $facilityBranch
     * @return void
     */
    public function deleted(FacilityBranch $facilityBranch)
    {
        //
    }

    /**
     * Handle the FacilityBranch "restored" event.
     *
     * @param  \App\Models\FacilityBranch  $facilityBranch
     * @return void
     */
    public function restored(FacilityBranch $facilityBranch)
    {
        //
    }

    /**
     * Handle the FacilityBranch "force deleted" event.
     *
     * @param  \App\Models\FacilityBranch  $facilityBranch
     * @return void
     */
    public function forceDeleted(FacilityBranch $facilityBranch)
    {
        //
    }


    private function createDefaultRole(string $facilityBranchId)
    {
        $role = Role::factory()->create([
            'facility_branch_id' => $facilityBranchId
        ]);

        //assign permissions
        echo "Assigning permissions\n";
        $role->givePermissionTo(Permission::all());
    }
}
