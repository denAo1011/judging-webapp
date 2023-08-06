<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CompanyEntryController;
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

// Public routes
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('logout', [AuthenticationController::class, 'logout']);
Route::post('companies/{company}/companyEntries', [CompanyEntryController::class, 'store']);

// Authenticated routes
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

    // Company entries routes
    Route::get('companyEntries', [CompanyEntryController::class, 'index']);
    Route::get('companyEntries/{companyEntry}', [CompanyEntryController::class, 'show']);
    Route::put('companyEntries/{companyEntry}', [CompanyEntryController::class, 'update']);
    Route::delete('companyEntries/{companyEntry}', [CompanyEntryController::class, 'destroy']);
});

// Requests for this group, MUST contain header "Company-Token"
Route::group(['middleware' => 'auth.companyToken'], function() {

});
