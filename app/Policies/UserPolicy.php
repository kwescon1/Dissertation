<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{

    private $editUser, $viewUser, $deleteUser;

    public function __construct()
    {
        $this->editUser = 'edit-users';
        $this->viewUser = 'view-users';
        $this->deleteUser = 'delete-users';
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

        return $userRole->hasAnyDirectPermission([$this->editUser, $this->viewUser]);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        //
        $userRole = $user->loggedInBranch->roles[0];
        $facilityId = $user->loggedInBranch->facility_id;

        return $userRole->hasAnyDirectPermission([$this->editUser, $this->viewUser]) && $user->facility_id == $facilityId;
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

        return $userRole->hasDirectPermission($this->editUser);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        //
        $userRole = $user->loggedInBranch->roles[0];
        $facilityId = $user->loggedInBranch->facility_id;

        return $userRole->hasDirectPermission($this->editUser) && $model->facility_id == $facilityId;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        //

        $userRole = $user->loggedInBranch->roles[0];

        $facilityId = $user->loggedInBranch->facility_id;

        return $userRole->hasAnyDirectPermission([$this->editUser, $this->deleteUser]) && $model->facility_id == $facilityId && $user->id != $model->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
