<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{

    private $editRole, $viewRole, $deleteRole;

    public function __construct()
    {
        $this->editRole = 'edit-roles';
        $this->viewRole = 'view-roles';
        $this->deleteRole = 'delete-roles';
    }



    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
        $userRole = $user->loggedInBranch->roles[0];

        return $userRole->hasAnyDirectPermission([$this->editRole, $this->viewRole]);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Role $role)
    {
        //
        $userRole = $user->loggedInBranch->roles[0];
        $facilityBranchId = $user->loggedInBranch->facility_branch_id;

        return $userRole->hasAnyDirectPermission([$this->editRole, $this->viewRole]) && $role->facility_branch_id == $facilityBranchId;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
        $userRole = $user->loggedInBranch->roles[0];

        return $userRole->hasDirectPermission($this->editRole);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Role $role)
    {
        //
        $userRole = $user->loggedInBranch->roles[0];
        $facilityBranchId = $user->loggedInBranch->facility_branch_id;

        return $userRole->hasDirectPermission($this->editRole) && $role->facility_branch_id == $facilityBranchId;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Role $role)
    {
        //
        $userRole = $user->loggedInBranch->roles[0];

        $facilityBranchId = $user->loggedInBranch->facility_branch_id;

        return $userRole->hasAnyDirectPermission([$this->editRole, $this->deleteRole]) && $role->facility_branch_id == $facilityBranchId;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
