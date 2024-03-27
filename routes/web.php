<?php

use App\Enum\RolesEnum;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\AdvertManagementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/u/{url}', ProfileController::class)->name('profile');
Route::resource('adverts', AdvertController::class)->only(['index', 'show']);

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('my-account')->name('my-account.')->group(function () {
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings');
        Route::resource('adverts', AdvertManagementController::class)->except(['show']);
    });

    Route::group(['middleware' => 'role:'.RolesEnum::ADMIN->value, 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', AdminController::class)->name('dashboard');
        Route::get('/contracts', [ContractController::class, 'index'])->name('contracts');
        Route::get('/contracts/{user}/export', [ContractController::class, 'exportContract'])->name('contracts.export');
        Route::post('/contracts/{user}/upload', [ContractController::class, 'uploadContract'])->name('contracts.upload');
        Route::post('/contracts/{contract}/approve', [ContractController::class, 'approveContract'])->name('contracts.approve');
    });

});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/logout', LogoutController::class)->name('logout')->middleware('auth');

