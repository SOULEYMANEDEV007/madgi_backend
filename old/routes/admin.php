<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\Auth\Admin\ForgotPasswordController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\ResetPasswordController;
use App\Http\Controllers\AvailableController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExternalController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\FixedController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportPersonalController;
use App\Http\Controllers\InfosController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RetirementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SignatoryController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TemporaryWorkerController;
use App\Http\Controllers\UnlockController;
use App\Http\Controllers\WorkerController;
use App\Livewire\Banners;
use Illuminate\Support\Facades\Route;
use App\Models\Permission as ModelsPermission;
use Illuminate\Support\Facades\Artisan;

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

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('clean', fn() => Artisan::call('optimize:clear'));

Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('workers', WorkerController::class)->middleware('permission:' . ModelsPermission::WORKER['READ']);
    Route::get('workers-search', [WorkerController::class, 'search'])->middleware('permission:' . ModelsPermission::WORKER['READ'])->name('workers.search');
    Route::post('workers-search', [WorkerController::class, 'search'])->middleware('permission:' . ModelsPermission::WORKER['READ'])->name('workers.search');
    Route::put('worker-toogle/{id}', [WorkerController::class, 'toogle'])->middleware('permission:' . ModelsPermission::WORKER['READ'])->name('workers.toogle');
    Route::post('workers-export', [WorkerController::class, 'export'])->middleware('permission:' . ModelsPermission::WORKER['READ'])->name('workers-export');
    Route::get('workers-pdf', [WorkerController::class, 'pdf'])->middleware('permission:' . ModelsPermission::WORKER['READ'])->name('workers-pdf');
    Route::get('workers-stats', [WorkerController::class, 'stats'])->middleware('permission:' . ModelsPermission::WORKER['READ'])->name('workers.stats');

    Route::get('workers-disable', [WorkerController::class, 'userDisable'])->middleware('permission:' . ModelsPermission::WORKER['READ'])->name('workers.userDisable');
    Route::post('workers-file', [WorkerController::class, 'uploadFile'])->middleware('permission:' . ModelsPermission::WORKER['READ'])->name('workers.file');
    Route::delete('workers-delete-file/{id}', [WorkerController::class, 'deleteFile'])->middleware('permission:' . ModelsPermission::WORKER['READ'])->name('workers.delete.file');

    Route::resource('interns', InternController::class)->middleware('permission:' . ModelsPermission::INTERN['READ']);
    Route::post('interns-search', [InternController::class, 'search'])->middleware('permission:' . ModelsPermission::INTERN['READ'])->name('interns.search');
    Route::put('intern-toogle/{id}', [InternController::class, 'toogle'])->middleware('permission:' . ModelsPermission::INTERN['READ'])->name('interns.toogle');
    Route::post('interns-export', [InternController::class, 'export'])->middleware('permission:' . ModelsPermission::INTERN['READ'])->name('interns-export');

    Route::get('interns-disable', [InternController::class, 'userDisable'])->middleware('permission:' . ModelsPermission::INTERN['READ'])->name('interns.userDisable');

    Route::resource('temporary-workers', TemporaryWorkerController::class)->middleware('permission:' . ModelsPermission::TEMPORARYWORKER['READ']);
    Route::post('temporary-workers-search', [TemporaryWorkerController::class, 'search'])->middleware('permission:' . ModelsPermission::TEMPORARYWORKER['READ'])->name('temporary-workers.search');
    Route::put('temporary-workers-toogle/{id}', [TemporaryWorkerController::class, 'toogle'])->middleware('permission:' . ModelsPermission::TEMPORARYWORKER['READ'])->name('temporary-workers.toogle');
    Route::post('temporary-workers-export', [TemporaryWorkerController::class, 'export'])->middleware('permission:' . ModelsPermission::TEMPORARYWORKER['READ'])->name('temporary-workers-export');

    Route::get('temporary-disable', [TemporaryWorkerController::class, 'userDisable'])->middleware('permission:' . ModelsPermission::TEMPORARYWORKER['READ'])->name('temporary-workers.userDisable');


    Route::resource('employees', EmployeeController::class)->middleware('permission:' . ModelsPermission::EMPLOYEE['READ']);
    Route::post('employees-search', [EmployeeController::class, 'search'])->middleware('permission:' . ModelsPermission::EMPLOYEE['READ'])->name('employees.search');
    Route::put('employees-toogle/{id}', [EmployeeController::class, 'toogle'])->middleware('permission:' . ModelsPermission::EMPLOYEE['READ'])->name('employees.toogle');
    Route::post('employees-export', [EmployeeController::class, 'export'])->middleware('permission:' . ModelsPermission::EMPLOYEE['READ'])->name('employees-export');

    Route::get('employees-disable', [EmployeeController::class, 'userDisable'])->middleware('permission:' . ModelsPermission::EMPLOYEE['READ'])->name('employees.userDisable');


    Route::resource('officials', OfficialController::class)->middleware('permission:' . ModelsPermission::OFFICIAL['READ']);
    Route::post('officials-search', [OfficialController::class, 'search'])->middleware('permission:' . ModelsPermission::OFFICIAL['READ'])->name('officials.search');
    Route::put('officials-toogle/{id}', [OfficialController::class, 'toogle'])->middleware('permission:' . ModelsPermission::OFFICIAL['READ'])->name('officials.toogle');
    Route::post('officials-export', [OfficialController::class, 'export'])->middleware('permission:' . ModelsPermission::OFFICIAL['READ'])->name('officials-export');

    Route::get('officials-disable', [OfficialController::class, 'userDisable'])->middleware('permission:' . ModelsPermission::OFFICIAL['READ'])->name('officials.userDisable');


    Route::resource('externals', ExternalController::class)->middleware('permission:' . ModelsPermission::EXTERNAL['READ']);
    Route::post('externals-search', [ExternalController::class, 'search'])->middleware('permission:' . ModelsPermission::EXTERNAL['READ'])->name('externals.search');
    Route::put('externals-toogle/{id}', [ExternalController::class, 'toogle'])->middleware('permission:' . ModelsPermission::EXTERNAL['READ'])->name('externals.toogle');
    Route::post('externals-export', [ExternalController::class, 'export'])->middleware('permission:' . ModelsPermission::EXTERNAL['READ'])->name('externals-export');

    Route::get('externals-disable', [ExternalController::class, 'userDisable'])->middleware('permission:' . ModelsPermission::EXTERNAL['READ'])->name('externals.userDisable');


    Route::resource('fixed', FixedController::class)->middleware('permission:' . ModelsPermission::FIXED['READ']);
    Route::post('fixed-search', [FixedController::class, 'search'])->middleware('permission:' . ModelsPermission::FIXED['READ'])->name('fixed.search');
    Route::put('fixed-toogle/{id}', [FixedController::class, 'toogle'])->middleware('permission:' . ModelsPermission::FIXED['READ'])->name('fixed.toogle');
    Route::post('fixed-export', [FixedController::class, 'export'])->middleware('permission:' . ModelsPermission::FIXED['READ'])->name('fixed-export');

    Route::get('fixed-disable', [FixedController::class, 'userDisable'])->middleware('permission:' . ModelsPermission::FIXED['READ'])->name('fixed.userDisable');


    Route::resource('availables', AvailableController::class)->middleware('permission:' . ModelsPermission::AVAILABLE['READ']);
    Route::post('availables-search', [AvailableController::class, 'search'])->middleware('permission:' . ModelsPermission::AVAILABLE['READ'])->name('availables.search');
    Route::put('availables-toogle/{id}', [AvailableController::class, 'toogle'])->middleware('permission:' . ModelsPermission::AVAILABLE['READ'])->name('availables.toogle');
    Route::post('availables-export', [AvailableController::class, 'export'])->middleware('permission:' . ModelsPermission::AVAILABLE['READ'])->name('availables-export');

    Route::get('availables-disable', [AvailableController::class, 'userDisable'])->middleware('permission:' . ModelsPermission::AVAILABLE['READ'])->name('availables.userDisable');


    Route::resource('retirements', RetirementController::class)->middleware('permission:' . ModelsPermission::AVAILABLE['READ']);
    Route::post('retirements-search', [RetirementController::class, 'search'])->middleware('permission:' . ModelsPermission::AVAILABLE['READ'])->name('retirements.search');
    Route::put('retirements-toogle/{id}', [RetirementController::class, 'toogle'])->middleware('permission:' . ModelsPermission::AVAILABLE['READ'])->name('retirements.toogle');
    Route::post('retirements-export', [RetirementController::class, 'export'])->middleware('permission:' . ModelsPermission::AVAILABLE['READ'])->name('retirements-export');

    Route::get('retirements-disable', [RetirementController::class, 'userDisable'])->middleware('permission:' . ModelsPermission::AVAILABLE['READ'])->name('retirements.userDisable');


    Route::resource('registrations', RegistrationController::class)->middleware('permission:' . ModelsPermission::REGISTER['READ']);
    Route::get('registrations-search', [RegistrationController::class, 'search'])->middleware('permission:' . ModelsPermission::REGISTER['READ'])->name('registrations.search');
    Route::get('registrations-export', [RegistrationController::class, 'export'])->middleware('permission:' . ModelsPermission::REGISTER['READ'])->name('registrations-export');
    Route::put('registration-toogle/{id}', [RegistrationController::class, 'toogle'])->middleware('permission:' . ModelsPermission::REGISTER['READ'])->name('registrations.toogle');
    Route::get('registrations-stats', [RegistrationController::class, 'stats'])->middleware('permission:' . ModelsPermission::REGISTER['READ'])->name('registrations.stats');
    Route::get('registrations/stats-export/{start}/{end}', [RegistrationController::class, 'exportStats'])->middleware('permission:' . ModelsPermission::REGISTER['READ'])->name('registrations-stats-export');
    Route::get('registrations/stats-user-export/{id}/{start}/{end}', [RegistrationController::class, 'exportUserStats'])->middleware('permission:' . ModelsPermission::REGISTER['READ'])->name('registrations-stats-user-export');
    Route::get('registrations-search-stats/{start_date?}/{end_date?}', [RegistrationController::class, 'searchStats'])->middleware('permission:' . ModelsPermission::REGISTER['READ'])->name('registrations.stats.search');
    Route::get('registrations-present', [RegistrationController::class, 'search'])->middleware('permission:' . ModelsPermission::REGISTER['READ'])->name('registrations.present');
    Route::get('registrations-absent', [RegistrationController::class, 'search'])->middleware('permission:' . ModelsPermission::REGISTER['READ'])->name('registrations.absent');

    Route::resource('infos', InfosController::class)->middleware('permission:' . ModelsPermission::INFO['READ']);
    Route::get('infos-search', [InfosController::class, 'search'])->middleware('permission:' . ModelsPermission::INFO['READ'])->name('infos.search');
    Route::put('infos-toogle/{id}', [InfosController::class, 'toogle'])->middleware('permission:' . ModelsPermission::INFO['READ'])->name('infos.toogle');

    Route::resource('import-personals', ImportPersonalController::class)->middleware('permission:' . ModelsPermission::PERSONAL['IMPORT']);
    Route::resource('factors', FactorController::class)->middleware('permission:' . ModelsPermission::FACTOR['READ']);
    Route::get('factors-search', [FactorController::class, 'search'])->middleware('permission:' . ModelsPermission::FACTOR['READ'])->name('factors.search');
    Route::resource('roles', RoleController::class)->middleware('permission:' . ModelsPermission::ROLE['READ']);
    Route::resource('admins', AdminController::class)->middleware('permission:' . ModelsPermission::ADMIN['READ']);
    Route::get('admins-search', [AdminController::class, 'search'])->middleware('permission:' . ModelsPermission::ADMIN['READ'])->name('admins.search');
    Route::resource('departements', DepartementController::class)->middleware('permission:' . ModelsPermission::DEPARTMENT['READ']);
    Route::get('departements-search', [DepartementController::class, 'search'])->middleware('permission:' . ModelsPermission::DEPARTMENT['READ'])->name('departements.search');
    Route::resource('signatories', SignatoryController::class)->middleware('permission:' . ModelsPermission::DEPARTMENT['READ']);
    Route::get('signatories-search', [DepartementController::class, 'search'])->middleware('permission:' . ModelsPermission::DEPARTMENT['READ'])->name('signatories.search');
    Route::resource('grades', GradeController::class)->middleware('permission:' . ModelsPermission::GRADE['READ']);
    Route::get('grades-search', [GradeController::class, 'search'])->middleware('permission:' . ModelsPermission::GRADE['READ'])->name('grades.search');
    Route::resource('services', ServiceController::class)->middleware('permission:' . ModelsPermission::SERVICE['READ']);
    Route::get('services-search', [ServiceController::class, 'search'])->middleware('permission:' . ModelsPermission::SERVICE['READ'])->name('services.search');
    Route::resource('activities', ActivityController::class)->middleware('permission:' . ModelsPermission::SERVICE['READ']);
    Route::get('activities-search', [ActivityController::class, 'search'])->middleware('permission:' . ModelsPermission::SERVICE['READ'])->name('activities.search');
    Route::resource('sites', SiteController::class)->middleware('permission:' . ModelsPermission::SITE['READ']);
    Route::get('sites-search', [SiteController::class, 'search'])->middleware('permission:' . ModelsPermission::SITE['READ'])->name('sites.search');

    Route::resource('leaves', LeaveController::class)->middleware('permission:' . ModelsPermission::LEAVE['READ']);
    Route::get('leaves-stats', [LeaveController::class, 'stats'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves.stats');
    Route::get('leaves-search', [LeaveController::class, 'search'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves.search');
    Route::get('leaves-result/{id}', [LeaveController::class, 'result'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves.result');
    Route::get('leaves/stats-export/{start}/{end}', [LeaveController::class, 'exportStats'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves-stats-export');
    Route::get('leaves/stats-single-export/{id}', [LeaveController::class, 'exportSingleStats'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves-stats-single-export');
    Route::get('leaves/stats-user-export/{id}/{start}/{end}', [LeaveController::class, 'exportUserStats'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves-stats-user-export');
    Route::get('leaves-search-stats/{start_date?}/{end_date?}', [LeaveController::class, 'searchStats'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves.stats.search');
    Route::get('leaves-download/{id}', [LeaveController::class, 'download'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves.download');
    Route::get('leaves-single/{id}', [LeaveController::class, 'statSingle'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves.single');
    Route::post('create-leaves-year', [LeaveController::class, 'createAssignLeave'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves.create.year');
    Route::post('update-leaves-year', [LeaveController::class, 'updateAssignLeave'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves.update.year');
    Route::delete('delete-leaves-year/{id}', [LeaveController::class, 'deleteAssignLeave'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('leaves.delete.year');
    Route::get('leaves-appreciation/{id}', [LeaveController::class, 'appreciation'])->name('leaves.appreciation');
    Route::patch('leaves-appreciation/{id}', [LeaveController::class, 'updateAppreciation'])->name('leaves.updateAppreciation');

    Route::get('/banners', Banners::class)->middleware('permission:' . ModelsPermission::BANNER['READ'])->name('banners');
    Route::resource('settings', SettingController::class)->middleware('permission:' . ModelsPermission::BANNER['READ']);

    Route::resource('assessments', AssessmentController::class)->middleware('permission:' . ModelsPermission::ASSESSMENT['READ']);
    Route::get('histories-assessment', [AssessmentController::class, 'histories'])->name('assessments.history')->middleware('permission:' . ModelsPermission::ASSESSMENT['ACCESS']);
    Route::get('recaps-assessment/{id}', [AssessmentController::class, 'recapitulation'])->name('assessments.recap')->middleware('permission:' . ModelsPermission::ASSESSMENT['ACCESS']);

    Route::resource('form-fields', FormFieldController::class)->middleware('permission:' . ModelsPermission::FORMFIELD['READ']);

    Route::resource('certificates', CertificateController::class)->middleware('permission:' . ModelsPermission::CERTIFICAT['READ']);
    Route::get('certificates-search', [CertificateController::class, 'search'])->middleware('permission:' . ModelsPermission::CERTIFICAT['READ'])->name('certificates.search');
    Route::get('certificates-download/{id}', [CertificateController::class, 'download'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('certificates.download');

    Route::get('certificates-doc/{id}', [CertificateController::class, 'docEdit'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('certificates.doc-edit');
    Route::post('certificates-doc/{id}', [CertificateController::class, 'docUpdate'])->middleware('permission:' . ModelsPermission::LEAVE['READ'])->name('certificates.doc-update');


    Route::resource('unlocks', UnlockController::class)->middleware('permission:' . ModelsPermission::UNLOCK['READ']);
    Route::resource('holidays', HolidayController::class)->middleware('permission:' . ModelsPermission::HOLIDAY['READ']);

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/store-message', [MessageController::class, 'store'])->name('messages.store');
    Route::post('/send-message/{id}', [MessageController::class, 'sendSingle'])->name('messages.single');
    Route::get('message-search', [MessageController::class, 'search'])->name('messages.search');
    Route::get('/messages-delivered', [MessageController::class, 'delivered'])->name('messages.delivered');
    Route::get('/messages-sent', [MessageController::class, 'sent'])->name('messages.sent');
    Route::get('/messages-error', [MessageController::class, 'error'])->name('messages.error');
});
Route::get('/send-messages', [MessageController::class, 'send'])->name('messages.send');
Route::get('leaves-download/{id}', [LeaveController::class, 'download'])->name('leaves.download');
Route::get('certificates-download/{id}', [CertificateController::class, 'download'])->name('certificates.download');
