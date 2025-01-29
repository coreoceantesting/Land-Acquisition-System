<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcquisitionAssistantController;
use App\Http\Controllers\AcquisitionRegisterController;
use App\Http\Controllers\DependentDropdownController;

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

Route::get('/', function () {
    return redirect()->route('login');
})->name('/');


// Guest Users
Route::middleware(['guest', 'PreventBackHistory', 'firewall.all'])->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('signin');
    Route::get('register', [App\Http\Controllers\Admin\AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [App\Http\Controllers\Admin\AuthController::class, 'register'])->name('signup');
});




// Authenticated users
Route::middleware(['auth', 'PreventBackHistory', 'firewall.all'])->group(function () {

    // Auth Routes
    Route::get('home', fn () => redirect()->route('dashboard'))->name('home');
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'Logout'])->name('logout');
    Route::get('change-theme-mode', [App\Http\Controllers\Admin\DashboardController::class, 'changeThemeMode'])->name('change-theme-mode');
    Route::get('show-change-password', [App\Http\Controllers\Admin\AuthController::class, 'showChangePassword'])->name('show-change-password');
    Route::post('change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'])->name('change-password');



    // Masters

    Route::prefix('admin')->group(function () {
        Route::resource('wards', App\Http\Controllers\Admin\Masters\WardController::class);
        Route::resource('districts', App\Http\Controllers\Admin\Masters\DistrictController::class);
        Route::resource('talukas', App\Http\Controllers\Admin\Masters\TalukaController::class);
        Route::resource('villages', App\Http\Controllers\Admin\Masters\VillageController::class);
        Route::resource('land_acquisitions', App\Http\Controllers\Admin\Masters\LandAcquisitionController::class);
        Route::resource('sr_nos', App\Http\Controllers\Admin\Masters\SrNoController::class);
        Route::resource('bundles', App\Http\Controllers\Admin\Masters\BundleController::class);
        Route::resource('years', App\Http\Controllers\Admin\Masters\YearController::class);

    });



    // Route::resource('create', App\Http\Controllers\AcquisitionAssistantController::class);

    // Route::resource('acquisition_assistant', App\Http\Controllers\AcquisitionAssistantController::class);
//     Route::get('acquisition_assistants/register', [AcquisitionRegisterController::class, 'register'])
// ->name('acquisition_register.register');
// Route::post('/acquisition-assistant/store', [AcquisitionRegisterController::class, 'store'])->name('acquisition_register.store');
// Route::get('acquisition_assistants/record', [AcquisitionRegisterController::class, 'show'])
// ->name('acquisition_register.record');

Route::resource('acquisition_register', AcquisitionRegisterController::class);
Route::get('acquisition_register/{id}', [AcquisitionRegisterController::class, 'show'])
    ->name('acquisition_register.show');

    Route::post('/acquisition_assistant/{id}/approve', [AcquisitionAssistantController::class, 'approve'])
    ->name('acquisition_assistant.approve');

    Route::post('acquisition_assistant/{id}/reject', [AcquisitionAssistantController::class, 'reject'])
    ->name('acquisition_assistant.reject');
    // Or if you are using resource routes:


    // Route::get('acquisition_assistant/{acquisition_assistant}', [AcquisitionAssistantController::class, 'show'])->name('acquisition_assistant.show');

    // Route::get('/acquisition_assistant/pending', [AcquisitionAssistantController::class, 'pending'])->name('acquisition_assistant.pending');

    Route::get('acquisition_assistant/pending', [AcquisitionAssistantController::class, 'pending'])->name('acquisition_assistant.pending');

    Route::get('/acquisition_assistant/approved', [AcquisitionAssistantController::class, 'approved'])->name('acquisition_assistant.approved');

    Route::get('acquisition_assistant/rejected', [AcquisitionAssistantController::class, 'rejected'])->name('acquisition_assistant.rejected');

    Route::get('acquisition_assistant/land_acquisition', [AcquisitionAssistantController::class, 'land_acquisition'])->name('acquisition_assistant.land_acquisition');

    Route::Post('acquisition_assistant/complete_auth', [AcquisitionAssistantController::class, 'complete_auth'])->name('acquisition_assistant.complete_auth');
    // Route::get('acquisition_assistant/complete_auth', [AcquisitionAssistantController::class, 'complete_auth'])->name('acquisition_assistant.complete_auth');
    Route::get('acquisition_assistant/complete_reco_auth', [AcquisitionAssistantController::class, 'complete_reco_auth'])->name('acquisition_assistant.complete_reco_auth');
    Route::resource('acquisition_assistant', AcquisitionAssistantController::class); // This will generate all the necessary routes, including the PATCH/PUT route.

    // Route::get('/get-dependent-options/{id}', [DependentDropdownController::class, 'getDependentOptions']);

    // Users Roles n Permissions
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::get('users/{user}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggle'])->name('users.toggle');
    Route::get('users/{user}/retire', [App\Http\Controllers\Admin\UserController::class, 'retire'])->name('users.retire');
    Route::put('users/{user}/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('users.change-password');
    Route::get('users/{user}/get-role', [App\Http\Controllers\Admin\UserController::class, 'getRole'])->name('users.get-role');
    Route::put('users/{user}/assign-role', [App\Http\Controllers\Admin\UserController::class, 'assignRole'])->name('users.assign-role');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
});

Route::post('/acquisition_assistants/{id}/approve', [AcquisitionAssistantController::class, 'approve'])->name('acquisition_assistants.approve');
Route::post('/acquisition_assistants/{id}/reject', [AcquisitionAssistantController::class, 'reject'])->name('acquisition_assistants.reject');
// Route::get('/acquisition_assistants', [AcquisitionAssistantController::class, 'index'])->name('acquisition_assistants.index');

Route::get('/php', function (Request $request) {
    if (!auth()->check())
        return 'Unauthorized request';

    Artisan::call($request->artisan);
    return dd(Artisan::output());
});
