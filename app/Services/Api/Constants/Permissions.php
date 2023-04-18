<?php

namespace App\Services\Api\Constants;

class Permissions
{
    //user permissions
    const EDIT_USER = 'edit-users';
    const VIEW_USER = 'view-users';
    const DELETE_USER = 'delete-users';

    //role permissions
    const EDIT_ROLE = 'edit-roles';
    const VIEW_ROLE = 'view-roles';
    const DELETE_ROLE = 'delete-roles';

    //client permissions
    const EDIT_CLIENT = 'edit-clients';
    const VIEW_CLIENT = 'view-clients';
    const DELETE_CLIENT = 'delete-clients';

    //appointment permissions
    const EDIT_APPOINTMENT = 'edit-appointments';
    const VIEW_APPOINTMENT = 'view-appointments';
    const DELETE_APPOINTMENT = 'delete-appointments';
}
