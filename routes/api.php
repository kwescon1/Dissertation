<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * All unprotected routes.
 */

Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::get('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::middleware('role')->apiResource('roles', App\Http\Controllers\Api\RoleController::class);
});


/**
 * configure routes for chatbot
 */
Route::post('/messages', [App\Http\Controllers\Chatbot\ChatbotController::class, 'onMessageReceived']);

//status of message
Route::post('/status', [App\Http\Controllers\Chatbot\ChatbotController::class, 'status']);


/**
 * Verify client registration route
 */
Route::get('client-registration-link/{facilityId}/{branchId}/{client}/{hash}', [App\Http\Controllers\Api\ClientController::class, 'verifyClientRegistrationLink'])->middleware(['throttle:6,1'])->name('client.registration.verify');


Route::apiResource('clients', App\Http\Controllers\Api\ClientController::class);
