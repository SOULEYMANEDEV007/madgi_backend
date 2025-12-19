<?php

use App\Http\Controllers\API\HomeAPIController;
use App\Http\Controllers\API\LeaveAPIController;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EmargementController;
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

Route::prefix('v1')->group(function() {

    Route::post('/connexion', [AuthController::class,'connexion']);
    Route::get('/generate-qr', [EmargementController::class, 'generateQr']);
    Route::post('/emarger', [EmargementController::class,'emarger']);
    Route::middleware(['auth:sanctum'])->group(function ()  {
        //Route::post('/emarger', [EmargementController::class,'emarger']);
        //Route::post('scan-emargement', [EmargementController::class, 'scanEmargement']);
        //Route::get('/generate-qr', [EmargementController::class, 'generateQr']);
        Route::post('/get-agent', [EmargementController::class,'getAgent']);
        Route::get('/work-time', [HomeAPIController::class,'setting']);
        //Route::post('/emarger', [EmargementController::class,'emarger']);
        Route::post('scan-emargement', [EmargementController::class, 'scanEmargement']);
        
    

        // Cyborg implement routes
        Route::get('user-info', [UserAPIController::class, 'user']);
        Route::get('infos', [HomeAPIController::class, 'infos']);
        Route::get('info/{id}', [HomeAPIController::class, 'read']);
        Route::post('update-user', [UserAPIController::class, 'updateUser']);
        Route::get('/banners', [HomeAPIController::class, 'banners']);
        Route::resource('leaves', LeaveAPIController::class)->except(['create', 'edit']);
        Route::get('/departments', [HomeAPIController::class, 'departments']);
        Route::get('/services', [HomeAPIController::class, 'services']);
        Route::get('/type-leaves', [HomeAPIController::class, 'typeLeaves']);
        Route::get('registers', [HomeAPIController::class, 'registers']);
        Route::post('register', [HomeAPIController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});