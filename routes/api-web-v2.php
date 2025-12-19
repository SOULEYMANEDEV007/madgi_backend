<?php

use App\Http\Controllers\V2\AssessmentController;
use App\Http\Controllers\Auth\Admin\ForgotPasswordController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\ResetPasswordController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Models\Permission as ModelsPermission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin', fn() => redirect(getGuardedRoute('home')));

// Routes d'authentification admin
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Routes protégées par auth admin
Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Routes Assessment principales
    Route::resource('assessments', AssessmentController::class)->middleware('permission:' . ModelsPermission::ASSESSMENT['READ']);
    
    // Routes spécifiques assessment
    Route::get('histories-assessment', [AssessmentController::class, 'histories'])->name('assessments.history')->middleware('permission:' . ModelsPermission::ASSESSMENT['ACCESS']);
    Route::get('recaps-assessment/{id}', [AssessmentController::class, 'recapitulation'])->name('assessments.recap')->middleware('permission:' . ModelsPermission::ASSESSMENT['ACCESS']);
});