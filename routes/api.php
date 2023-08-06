<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CompanyTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthenticationController::class, 'login']);
Route::post('logout', [AuthenticationController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Test route, whoami
    Route::get('whoami', function (Request $request) {
        return $request->user();
    });

    // Company routes
    Route::apiResource('companies', CompanyController::class);

    // CompanyToken routes
    Route::get('companies/{company}/token', [CompanyTokenController::class, 'show']);
    Route::post('companies/{company}/token', [CompanyTokenController::class, 'regenerate']);
});
