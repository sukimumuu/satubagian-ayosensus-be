<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\RegionController;
use App\Http\Controllers\Api\V1\DummyDataController;
use App\Http\Controllers\Api\V1\SensusFormulirController;
use App\Http\Controllers\Api\V1\OfficerManagementController;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    
    // Region
    Route::get('/region/subdistrict', [RegionController::class, 'getSubdistrict']);
    Route::post('/region/village', [RegionController::class, 'searchVillage']);

    // Dummy Data
    Route::get('/dummy/educations', [DummyDataController::class, 'dummyEducations']);
    Route::get('/dummy/jobs', [DummyDataController::class, 'dummyJobs']);
    
    Route::post('/check-nik', [AuthController::class, 'checkNik']);
    Route::post('/login-user', [AuthController::class, 'loginUser']);
    Route::post('/validasi-otp', [AuthController::class, 'validateOtp']);

    Route::middleware(['auth:api'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        // Sensus Formulir
        Route::get('/mulai-sensus', [SensusFormulirController::class, 'startSensus']);
        Route::post('/kirim-keluarga', [SensusFormulirController::class, 'storeFamily']);

        Route::middleware(['role:superadmin'])->group(function () {
            // Officer Management
            Route::get('/officer', [OfficerManagementController::class, 'index']);
            Route::post('/officer', [OfficerManagementController::class, 'store']);
        });
    });
});
