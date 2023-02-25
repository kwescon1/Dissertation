<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

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

        Response::macro('success', function ($data, $customCode = NULL) {
            return response()->json([
                'data' => $data ?: null,
                // 'customCode' => $customCode,
            ]);
        });

        Response::macro('created', function ($data, $customCode = NULL) {
            return response()->json([
                'data' => $data ?: null,
                // 'customCode' => $customCode
            ], \Illuminate\Http\Response::HTTP_CREATED);
        });

        Response::macro('notfound', function ($error, $customCode = NULL) {
            return response()->json([
                'error' => $error,
                // 'customCode' => $customCode
            ], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        });

        Response::macro('error', function ($error, $statusCode = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR, $customCode = 9999) {
            return response()->json([
                'error' => $error,
                // 'customCode' => $customCode,
            ], $statusCode);
        });
    }
}
