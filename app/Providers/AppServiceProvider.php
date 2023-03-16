<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\UserFacilityBranch;
use App\Services\Api\Auth\AuthService;
use App\Services\Api\User\UserService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use App\Services\Api\Client\ClientService;
use App\Services\Api\Facility\FacilityService;
use App\Services\Api\Auth\AuthServiceInterface;
use App\Services\Api\User\UserServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Api\Client\ClientServiceInterface;
use App\Services\Api\Facility\FacilityServiceInterface;
use App\Services\Api\FacilityBranch\FacilityBranchService;
use App\Services\Api\UserFacilityBranch\UserFacilityBranchService;
use App\Services\Api\FacilityBranch\FacilityBranchServiceInterface;
use App\Services\Api\ClientFacilityBranch\ClientFacilityBranchService;
use App\Services\Api\UserFacilityBranch\UserFacilityBranchServiceInterface;
use App\Services\Api\ClientFacilityBranch\ClientFacilityBranchServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(FacilityServiceInterface::class, FacilityService::class);
        $this->app->bind(FacilityBranchServiceInterface::class, FacilityBranchService::class);
        $this->app->bind(UserFacilityBranchServiceInterface::class, UserFacilityBranchService::class);
        $this->app->bind(ClientServiceInterface::class, ClientService::class);
        $this->app->bind(ClientFacilityBranchServiceInterface::class, ClientFacilityBranchService::class);


        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        //
        Schema::defaultStringLength(191);
        JsonResource::withoutwrapping();

        Response::macro('success', function ($data) {
            return response()->json([
                'data' => $data ?: null,

            ]);
        });

        Response::macro('created', function ($data) {
            return response()->json([
                'data' => $data ?: null,
            ], \Illuminate\Http\Response::HTTP_CREATED);
        });

        Response::macro('notfound', function ($error) {
            return response()->json([
                'error' => $error,

            ], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        });

        Response::macro('error', function ($error, $statusCode = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR) {
            return response()->json([
                'error' => $error,
                'status' => $statusCode,

            ], $statusCode);
        });
    }
}
