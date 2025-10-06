<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\RegionController;
use App\Http\Controllers\Api\V1\OfficerManagementController;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    // Region
    Route::get('/region/subdistrict', [RegionController::class, 'getSubdistrict']);
    Route::post('/region/village', [RegionController::class, 'searchVillage']);

    Route::middleware(['auth:api'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        Route::middleware(['role:superadmin'])->group(function () {
            // Officer Management
            Route::get('/officer', [OfficerManagementController::class, 'index']);
            Route::post('/officer', [OfficerManagementController::class, 'store']);
        });
    });
});
