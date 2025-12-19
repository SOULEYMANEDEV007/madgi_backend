<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfosController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', fn() => redirect(getGuardedRoute('home')));

Route::prefix('user')->group(function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::group(['middleware' => ['auth:web']], function() {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::resource('infos', InfosController::class);
        Route::get('infos-search', [InfosController::class, 'search'])->name('infos.search');
        Route::resource('registrations', RegistrationController::class);
        Route::get('registrations-search', [RegistrationController::class, 'search'])->name('registrations.search');
        Route::get('registrations/export/{date}', [RegistrationController::class, 'export'])->name('registrations-export');
        Route::put('registration-toogle/{id}', [RegistrationController::class, 'toogle'])->name('registrations.toogle');
        Route::get('registrations-stats', [RegistrationController::class, 'stats'])->name('registrations.stats');
        Route::get('registrations/stats-export/{start}/{end}', [RegistrationController::class, 'exportStats'])->name('registrations-stats-export');
        Route::get('registrations/stats-user-export/{id}/{start}/{end}', [RegistrationController::class, 'exportUserStats'])->name('registrations-stats-user-export');
        Route::get('registrations-search-stats/{start_date?}/{end_date?}', [RegistrationController::class, 'searchStats'])->name('registrations.stats.search');
        Route::resource('leaves', LeaveController::class);
        Route::get('leaves-edit/{id}', [LeaveController::class, 'editLeave'])->name('leaves.editLeave');
        Route::get('leaves-search', [LeaveController::class, 'search'])->name('leaves.search');
        Route::get('leaves-result/{id}', [LeaveController::class, 'result'])->name('leaves.result');
        Route::get('leaves-stats', [LeaveController::class, 'stats'])->name('leaves.stats');
        Route::get('leaves/stats-export/{start}/{end}', [LeaveController::class, 'exportStats'])->name('leaves-stats-export');
        Route::get('leaves/stats-user-export/{id}/{start}/{end}', [LeaveController::class, 'exportUserStats'])->name('leaves-stats-user-export');
        Route::get('leaves-search-stats/{start_date?}/{end_date?}', [LeaveController::class, 'searchStats'])->name('leaves.stats.search');
        Route::get('leaves-download/{id}', [LeaveController::class, 'download'])->name('leaves.download');
        Route::get('leaves-single/{id}', [LeaveController::class, 'statSingle'])->name('leaves.single');
        Route::resource('assessments', AssessmentController::class);
        Route::get('histories-assessment', [AssessmentController::class, 'histories'])->name('assessments.history');
        Route::get('recaps-assessment/{id}', [AssessmentController::class, 'recapitulation'])->name('assessments.recap');
        Route::resource('certificates', CertificateController::class);
        Route::get('certificates-search', [CertificateController::class, 'search'])->name('certificates.search');
        Route::get('certificates-doc/{id}', [CertificateController::class, 'docEdit'])->name('certificates.doc-edit');
        Route::post('certificates-doc/{id}', [CertificateController::class, 'docUpdate'])->name('certificates.doc-update');
    });
});
