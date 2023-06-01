<?php

namespace App\Services\Api\User;

use App\Models\User;
use App\Pipes\User\FindUser;
use App\Pipes\User\CreateUser;
use Illuminate\Routing\Pipeline;
use App\Services\Api\CoreService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use App\Pipes\User\VerifyFacilityExists;
use App\Pipes\User\FindUserFacilityBranch;
use App\Pipes\User\VerifyUsernameExistsForFacility;
use App\Pipes\User\VerifyRoleExistsInFacilityBranch;

class UserService extends CoreService implements UserServiceInterface
{

    /**
     * @param string $username
     * @return object?|NULL
     */
    public function findUserByUsername(string $username): ?object
    {
        return User::whereUsername($username)->first();
    }

    /**
     * @param string $facilityId
     * @param string $facilityBranchId
     * @return Collection|NULL
     */
    public function users(string $facilityId, string $facilityBranchId): ?Collection
    {
        Gate::authorize('viewAny', User::class);

        return User::whereFacilityId($facilityId)->whereHas('facilityBranches', function ($q) use ($facilityBranchId) {

            $q->where('facility_branch_id', $facilityBranchId);
        })->with(['userAccounts' => function ($query) use ($facilityId, $facilityBranchId) {
            $query->userAccounts($facilityId, $facilityBranchId)->with('roles');
        }])
            ->get();
    }

    /**
     * @param string $id
     * @param $facilityId
     * @param $facilityBranchId
     * @return object|NULL
     * @throws NotFoundException
     */
    public function user(string $id, string $facilityId, string $facilityBranchId): ?object
    {

        $user =  User::whereId($id)->whereFacilityId($facilityId)->whereHas('facilityBranches', function ($q) use ($facilityBranchId) {

            $q->where('facility_branch_id', $facilityBranchId);
        })->with(['userAccounts' => function ($query) use ($facilityId, $facilityBranchId) {
            $query->userAccounts($facilityId, $facilityBranchId)->with('roles');
        }])->first();


        if (!$user) {
            $this->throwNotFoundException('User', $id);
        }

        Gate::authorize('view', $user);

        return $user;
    }

    /**
     * Deletes a user by setting its status to deleted.
     *
     * @param string $id
     * @throws NotFoundException
     * @return bool
     */
    public function destroyUser(string $id, string $facilityId): bool
    {
        $user = User::whereId($id)->whereFacilityId($facilityId)->first();

        if (!$user) {
            $this->throwNotFoundException('User', $id);
        }

        Gate::authorize('delete', $user);

        return $user->delete();
    }


    /**
     * Creates a new user account.
     * NOTE: User status is as set to PENDING on default.
     *
     *
     * @param $data
     *
     * @throws NotFoundException
     * @throws ValidationException
     * @return Model|null
     */
    public function createUser(array $data): ?Model
    {
        // Gate::authorize('create', User::class);

        $pipes = [VerifyFacilityExists::class, VerifyUsernameExistsForFacility::class, VerifyRoleExistsInFacilityBranch::class, CreateUser::class];

        return app(Pipeline::class)->send($data)->through($pipes)->then(function ($content) {

            return $content;
        });
    }

    /**
     * @param array $data
     * @param string $id
     * @param string $facilityId
     * @param string $facilityBranchId
     * @throws NotFoundException
     */
    public function updateUser(array $data, string $id, string $facilityId, string $facilityBranchId): ?Model
    {

        $data['facility_id'] = $facilityId;

        $data['facility_branch_id'] = $facilityBranchId;

        $data['id'] = $id;

        $pipes = [VerifyRoleExistsInFacilityBranch::class, FindUser::class, FindUserFacilityBranch::class];


        return app(Pipeline::class)->send($data)->through($pipes)->then(function ($content) {

            $role = $content['role'];
            $user = $content['user'];
            $userFacilityBranch = $content['user_branch'];

            unset($content['facility_id'], $content['facility_branch_id'], $content['id'], $content['user_branch'], $content['role'], $content['user']);

            Gate::authorize('update', $user);

            $user->update($content);

            $userFacilityBranch->syncRoles($role);

            return $user;
        });
    }
}
