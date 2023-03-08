<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Http\Resources\LoginResource;
use App\Exceptions\BadRequestException;
use App\Services\Api\Auth\AuthServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;

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

        try {
            return response()->success(new LoginResource($this->authService->loginUser($credentials)));
        } catch (NotFoundException $e) {
            return response()->notfound($e->getMessage());
        } catch (BadRequestException $e) {
            return response()->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (AuthorizationException $e) {
            return response()->error($e->getMessage(), Response::HTTP_UNAUTHORIZED, 102);
        } catch (Exception $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->error($e->getMessage());
        }
    }
}
