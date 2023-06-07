<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (AuthorizationException $e) {
            //
            return response()->error($e->getMessage(), Response::HTTP_FORBIDDEN);
        });

        $this->renderable(function (AuthenticationException $e) {
            //
            return response()->error($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        });

        $this->renderable(function (AccessDeniedHttpException $e) {
            //
            return response()->error($e->getMessage(), Response::HTTP_FORBIDDEN);
        });

        $this->renderable(function (ValidationException $e) {
            //
            return response()->error($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        });

        $this->renderable(function (Exception $e) {
            //

            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->error($e->getMessage());
        });
    }
}
