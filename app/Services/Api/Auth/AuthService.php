<?php

namespace App\Services\Api\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Facility;
use App\Models\FacilityBranch;
use App\Services\Api\CoreService;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Redis;
use App\Exceptions\BadRequestException;
use App\Exceptions\ValidationException;
use App\Services\Api\User\UserServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use App\Services\Api\Facility\FacilityServiceInterface;
use App\Services\Api\FacilityBranch\FacilityBranchService;
use App\Services\Api\FacilityBranch\FacilityBranchServiceInterface;
use App\Services\Api\UserFacilityBranch\UserFacilityBranchServiceInterface;


class AuthService extends CoreService implements AuthServiceInterface
{

    private $userService;
    private $facilityBranchService;
    private $userFacilityBranchService;
    private $facilityService;

    public function __construct(UserServiceInterface $userService, FacilityBranchServiceInterface $facilityBranchService, UserFacilityBranchServiceInterface $userFacilityBranchService, FacilityServiceInterface $facilityService)
    {
        $this->userService = $userService;
        $this->facilityBranchService = $facilityBranchService;
        $this->userFacilityBranchService = $userFacilityBranchService;
        $this->facilityService = $facilityService;
    }


    /** @return array 
     * @param $data
     * 
     * */
    // public function register($data): ?array
    // {

    //     $data['password'] = $this->hashPassword($data['password']);

    //     $user = User::create($data);

    //     event(new Registered($user));

    //     //create token
    //     $token = $user->createToken('lemvan')->plainTextToken;

    //     $user['access_token'] = $token;

    //     return [
    //         'user' => $user,
    //     ];
    // }


    /**
     * Authenticates a user.
     *
     * @param $data
     *
     * @throws NotFoundException
     * @throws AuthorizationException
     * @return object
     */
    public function loginUser($data): object
    {

        $user = $this->userService->findUserByUsername(strtolower($data['username']));

        $facility_branch_id = null;

        isset($data['facility_branch_id']) ? $facility_branch_id = $data['facility_branch_id'] : $facility_branch_id = null;

        if (!$user) {
            throw new NotFoundException("User with username " . $data['username'] . " not found");
        }

        if ($user->status == $this->userService::STATUS_SUSPENDED) {
            throw new AuthorizationException("Your account has been suspended. Please contact your administrator.");
        }

        $isValidPassword = $this->checkPassword($data['password'], $user->password);


        if (!$isValidPassword) {
            throw new BadRequestException("Invalid password provided");
        }

        //get facility 
        $facility = $this->facilityService->getFacility($user->facility_id);

        if (!$facility) {
            throw new NotFoundException("Facility with id: $user->facility_id not found");
        }

        $loggedInBranchId = $this->logUserLoginTime($user->id, $user->facility_id, $facility_branch_id);

        // get facility branch
        $facilityBranch = $this->facilityBranchService->getFacilityBranch($facility->id, $loggedInBranchId);

        if (!$facilityBranch) {
            throw new NotFoundException("Facility Branch with id: $user->facility_branch_id not found");
        }

        //create token
        $token = $user->createToken('foviar')->plainTextToken;

        $user["facility_name"] = $facility->name;
        $user["facility_branch_id"] = $facilityBranch->id;
        $user["facility_branch_name"] = $facilityBranch->name;
        $user["token"] = $token;

        cache()->put(
            $user->id,
            [
                'id' => $user->id,
                'facility_id' => $facility->id,
                'facility_branch_id' => $facilityBranch->id
            ],
            self::LOGIN_CACHE_SECONDS
        );

        return $user;
    }

    /**
     * @param int    $facilityId
     * @param string $username
     *
     * @throws Exception
     * @return bool
     */
    // public function verifyUsername(string $username): object
    // {
    //     $user = $this->userRepository->model()->where('username', $username)->first();

    //     if (!$user) {
    //         throw new NotFoundException("User with username $username not found");
    //     } else {
    //         $status = $user->status;
    //         if ($status == $this->userService::STATUS_SUSPENDED) {
    //             throw new AuthorizationException("Your account has been suspended. Please contact your administrator.");
    //         }
    //         return $user;
    //     }
    // }

    /**
     * @param int    $userId
     * @param string $password
     *
     * @throws NotFoundException
     * @return bool
     */
    // public function resetPassword(int $userId, string $password): bool
    // {
    //     $hashedPassword = Hash::make($password);
    //     $userModel = $this->userRepository->find($userId);

    //     if (!$userModel) {
    //         throw new NotFoundException("User with id: {$userId} was not found");
    //     }

    //     $userModel->password = $hashedPassword;
    //     $userModel->status = $this->userService::STATUS_ACTIVE;
    //     return $userModel->update($userModel->toArray());
    // }

    /**
     * @param int    $userId
     * @param string $oldPassword
     * @param string $newPassword
     *
     * @throws NotFoundException
     * @return bool
     */
    // public function changePassword(int $userId, string $oldPassword, string $newPassword): bool
    // {
    //     $userModel = $this->userService->findUser($userId);

    //     if (!$userModel) {
    //         throw new NotFoundException("User with id: {$userId} was not found");
    //     }

    //     $isValidPassword = Hash::check($oldPassword, $userModel->password);
    //     if (!$isValidPassword) {
    //         throw new BadRequestException("Your current password is invalid");
    //     }

    //     $hashedPassword = Hash::make($newPassword);
    //     $userModel->password = $hashedPassword;
    //     return $userModel->update($userModel->toArray());
    // }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function logout(Request $request): bool
    {
        Redis::del(cache()->get(auth()->id())['facility_branch_id']);

        cache()->forget(auth()->id());


        return auth()->user()->tokens()->delete();
    }

    /**
     * Logs user login time and return facility branch id
     *
     * @param int      $userId
     * @param int      $facilityId
     * @param int|null $facility_branch_id
     *
     * @return int
     */
    private function logUserLoginTime(string $userId, string $facilityId, string $facilityBranchId = NULL): string
    {

        $userBranch = $this->userFacilityBranchService->getUserBranch($userId, $facilityId, $facilityBranchId);

        if (!$userBranch) {
            throw new BadRequestException("Invalid User Facility Branch");
        }

        $userBranch->current_login_at = Carbon::now();
        $userBranch->last_login_at = $userBranch->current_login_at;
        $userBranch->save();

        return $userBranch->facility_branch_id;
    }

    private function checkPassword($password, $userPassword): bool
    {
        return Hash::check($password, $userPassword);
    }
}
