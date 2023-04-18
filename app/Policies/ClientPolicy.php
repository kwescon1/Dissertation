<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Client;
use App\Services\Api\Constants\Permissions;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    private $editClient, $viewClient, $deleteClient;

    public function __construct()
    {
        $this->editClient = Permissions::EDIT_CLIENT;
        $this->viewClient = Permissions::VIEW_CLIENT;
        $this->deleteClient = Permissions::DELETE_CLIENT;
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

        return $userRole->hasAnyDirectPermission([$this->editClient, $this->viewClient]);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Client $client)
    {
        //
        $userRole = $user->loggedInBranch->roles[0];
        $facilityId = $user->loggedInBranch->facility_id;

        return $userRole->hasAnyDirectPermission([$this->editClient, $this->viewClient]) && $client->facility_id == $facilityId;
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

        return $userRole->hasDirectPermission($this->editClient);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Client $client)
    {
        //
        $userRole = $user->loggedInBranch->roles[0];
        $facilityId = $user->loggedInBranch->facility_id;

        return $userRole->hasDirectPermission($this->editClient) && $client->facility_id == $facilityId;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Client $client)
    {
        //
        $userRole = $user->loggedInBranch->roles[0];

        $facilityId = $user->loggedInBranch->facility_id;

        return $userRole->hasAnyDirectPermission([$this->editClient, $this->deleteClient]) && $client->facility_id == $facilityId;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Client $client)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Client $client)
    {
        //
    }
}
