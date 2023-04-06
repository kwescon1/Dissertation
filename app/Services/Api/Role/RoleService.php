<?php

namespace App\Services\Api\Role;

use App\Models\Role;
use App\Pipes\Role\CreateNewRole;
use App\Services\Api\CoreService;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Log;
use App\Pipes\Role\FetchPermissions;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Model;
use App\Pipes\Role\VerifyRoleDoesNotExist;
use Illuminate\Database\Eloquent\Collection;

class RoleService extends CoreService implements RoleServiceInterface
{
    private $viewAny, $view;

    public function __construct()
    {
        $this->viewAny = 'viewAny';
        $this->view = 'view';
    }

    /**
     * @param string $facilityBranchId
     * @return Collection|NULL
     */
    public function listRoles(string $facilityBranchId): ?Collection
    {
        $roles = Role::withCount('users')->whereFacilityBranchId($facilityBranchId)->get();

        Gate::authorize($this->viewAny, Role::class);

        return $roles;
    }

    /**
     * Get the specified resource.
     *
     * @param  string  $id
     * @param string $facilityBranchId
     * @return object|Null
     */
    public function role(string $id, string $facilityBranchId): ?object
    {
        $role = Role::whereId($id)->whereFacilityBranchId($facilityBranchId)->with('permissions', 'users.user')->first();


        if (!$role) {
            Log::error("Role with id: $id does not exist in this facility branch");

            throw new NotFoundException("The specified role does not exist");
        }

        Gate::authorize($this->view, $role);

        return $role;
    }

    /**
     * delete a specified role
     * @param string $id
     * @param string $facilityBranchId
     * @return bool
     */
    public function destroyRole(string $id, string $facilityBranchId): bool
    {
        $role = Role::whereId($id)->whereFacilityBranchId($facilityBranchId)->withCount('users')->first();

        if (!$role) {
            $this->throwNotFoundException("Role", $id);
        }


        Gate::authorize('delete', $role);

        return $role->users_count > 0 ?  $this->throwForbiddenException("This role cannot be deleted") : $role->delete();
    }

    /**
     * @param array $data
     * @param string $facilityBranchId
     * @return Model|Null
     */
    public function createRole(array $data, string $facilityBranchId): ?Model
    {
        Gate::authorize('create', Role::class);

        $data['facility_branch_id'] = $facilityBranchId;

        $pipes = [VerifyRoleDoesNotExist::class, FetchPermissions::class, CreateNewRole::class];

        return app(Pipeline::class)->send($data)->through($pipes)->then(function ($content) {

            return $content;
        });
    }
}
