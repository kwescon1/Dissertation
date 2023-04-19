<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use App\Services\Api\Auth\AuthServiceInterface;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    //
    /**
     * @param LoginUserRequest $request
     *
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        return response()->success(new LoginResource($this->authService->loginUser($credentials)));
    }

    public function logout(Request $request)
    {
        try {
            return response()->success($this->authService->logout($request));
        } catch (NotFoundException $e) {
            return response()->notfound($e->getMessage());
        } catch (Exception $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->error($e->getMessage());
        }
    }
}
