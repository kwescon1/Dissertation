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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * configure routes for chatbot
 */
Route::post('/messages', [App\Http\Controllers\Chatbot\ChatbotController::class, 'onMessageReceived']);

//status of message
Route::post('/status', [App\Http\Controllers\Chatbot\ChatbotController::class, 'status']);


/**
 * Client registration route
 */
Route::get('verify/client-registration-link', [App\Http\Controllers\Api\ClientController::class, 'verifyClientRegistrationLink']);
Route::apiResource('clients', App\Http\Controllers\Api\ClientController::class);
