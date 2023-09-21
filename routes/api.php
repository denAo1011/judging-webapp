<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CompanyEntryController;
use App\Http\Controllers\Api\CompanyJurorController;
use App\Http\Controllers\Api\JudgingController;
use App\Http\Controllers\Api\DashboardController;
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

Route::get('companies', [CompanyController::class, 'index']);
Route::post('companies/{company}/companyEntries', [CompanyEntryController::class, 'store']);

Route::get('companyJurors', [CompanyJurorController::class, 'index']);

// Authenticated routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Test route, whoami
    Route::get('whoami', function (Request $request) {
        return $request->user();
    });

    // Company routes
    Route::apiResource('companies', CompanyController::class)
        ->only(['store', 'show', 'update', 'destroy']);

    // Company entries routes
    Route::get('companyEntries', [CompanyEntryController::class, 'index']);
    Route::get('companyEntries/{companyEntry}', [CompanyEntryController::class, 'show']);
    Route::put('companyEntries/{companyEntry}', [CompanyEntryController::class, 'update']);
    Route::delete('companyEntries/{companyEntry}', [CompanyEntryController::class, 'destroy']);

    // Company jurors routes
    Route::get('companyJurors/{companyJuror}', [CompanyJurorController::class, 'show']);
    Route::put('companyJurors/{companyJuror}', [CompanyJurorController::class, 'update']);
    Route::delete('companyJurors/{companyJuror}', [CompanyJurorController::class, 'destroy']);

    // Create company juror
    Route::post('companies/{company}/companyJurors', [CompanyJurorController::class, 'store']);

    // Dashboard Route
    Route::get('dashboard/statistics', [DashboardController::class, 'getStatistics']);
    Route::get('dashboard/rankings', [DashboardController::class, 'getRankings']);

    // Reports
    Route::get('reports/companyEntries', [ReportController::class, 'downloadCompanyEntries']);
    Route::get('reports/companyEntryLevelOneRankings', [ReportController::class, 'downloadCompanyEntryLevelOneRankings']);
    Route::get('reports/companyEntryLevelTwoRankings', [ReportController::class, 'downloadCompanyEntryLevelTwoRankings']);
});

// Requests for this group, MUST contain header "X-Juror-Token"
Route::group(['middleware' => 'auth.companyToken'], function () {
    Route::get('tokenCheck', function () {
        return response()->json([
            'message' => 'Valid token',
            'juror' => request()->attributes->get('companyJuror', NULL)
        ]);
    });
    Route::get('judging', [JudgingController::class, 'index']); // List approved entries
    Route::post('judging', [JudgingController::class, 'submit']); // Submit scores
});
