<?php

use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LeadController;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/admin/dashboard');

Route::prefix('/admin')->group(function () {

    Route::view('/login', 'admin.login')->name('admin-login-view');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login_post');

    Route::middleware(['authenticate', 'user_activity'])->group( function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard-lead-partial', [HomeController::class, 'latestLeadPartial'])->name('admin.dashboard-lead-partial');

        Route::get('/agents', [AgentController::class, 'index'])->name('admin.agents-view');
        Route::get('/delete-agent/{id}', [AgentController::class, 'deleteAgent'])->name('admin.delete-agent');
        Route::get('/latest-active-agents', [AgentController::class, 'latestActiveAgent'])->name('admin.latest-active-agents');
        Route::get('/register', [AgentController::class, 'registerAdminAgent'])->name('admin.register-admin-agent');
        Route::post('/register-user', [AgentController::class, 'registerUser'])->name('admin.register-user');

        Route::get('/settings/{id?}', [AgentController::class, 'settingAccount'])->name('setting-account');
        Route::post('/update-settings/{id}', [AgentController::class, 'updateSettingAccount'])->name('admin.update-setting');

        Route::get('/profile/{id?}', [AgentController::class, 'userProfile'])->name('admin.profile');

        Route::get('/leads', [LeadController::class, 'index'])->name('admin.lead-view');
        Route::get('/add-edit-lead/{id?}', [LeadController::class, 'addEditLead'])->name('admin.lead-add-edit');
        Route::get('/view-lead/{id}', [LeadController::class, 'viewLead'])->name('admin.lead-detail-view');
        Route::post('/lead-generate-pdf/{id}', [LeadController::class, 'generatePdf'])->name('admin.generate-pdf');
        Route::post('/create-update-lead/{id?}', [LeadController::class, 'createUpdateLead'])->name('admin.lead-create-update');
        Route::get('/leads-data', [LeadController::class, 'leadData'])->name('admin.lead-data');
        Route::get('/delete-lead/{id}', [LeadController::class, 'deleteLead'])->name('admin.delete-lead');
        Route::post('/assign-lead/{id}', [LeadController::class, 'assignLead'])->name('admin.assign-lead');

        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    });
});
