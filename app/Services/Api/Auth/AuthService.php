<?php

namespace App\Services\Api\Auth;

use App\Services\Api\CoreService;


class AuthService extends CoreService implements AuthServiceInterface
{

    /**
     * Login type to be used by the service.
     *
     * @var string
     */
    private $fieldType;


    /** @return array 
     * @param $data
     * 
     * */
    public function register($data): ?array
    {

        $data['password'] = $this->hashPassword($data['password']);

        $user = User::create($data);

        event(new Registered($user));

        //create token
        $token = $user->createToken('lemvan')->plainTextToken;

        $user['access_token'] = $token;

        return [
            'user' => $user,
        ];
    }



    public function login($data): ?array
    {

        $fieldType = $this->fieldType($data['login']);

        //get user
        $user = User::where($fieldType, $data['login'])->first();

        //check password
        if (!$user || !$this->checkPassword($data['password'], $user)) {
            throw new ValidationException("Invalid $fieldType or password");
        }

        //create token
        $token = $user->createToken('foviar')->plainTextToken;

        $user['access_token'] = $token;

        return [
            'user' => $user,
        ];
    }


    /**
     * Get the login field to be used by the service class.
     *
     * @return string
     */
    private function fieldType($data): ?string
    {

        $fieldType = filter_var($data, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        return $fieldType;
    }

    /**
     * 
     * @param $password
     * @param $user
     * @return null|bool
     */
    private function checkPassword($password, User $user): ?bool
    {
        return Hash::check($password, $user->password);
    }

    private function hashPassword($password): string
    {
        return  Hash::make($password);
    }

    /**
     * end user session 
     * @param $request
     * @return bool
     */
    public function logout($request): bool
    {

        return auth()->user()->tokens()->delete();
    }
}
