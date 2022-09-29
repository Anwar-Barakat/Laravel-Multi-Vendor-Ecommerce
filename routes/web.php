<?php

use App\Http\Controllers\Admin\AdminSetting\AdminLoginController;
use App\Http\Controllers\Admin\AdminSetting\CheckPasswordController;
use App\Http\Controllers\Admin\AdminSetting\UpdateDetailController;
use App\Http\Controllers\Admin\AdminSetting\UpdatePasswordController;
use App\Http\Controllers\Admin\Section\SectionController;
use App\Http\Controllers\Admin\Section\UpdateSectionStatusController;
use App\Http\Controllers\Admin\Supervisor\AdminController;
use App\Http\Controllers\Admin\Supervisor\UpdateAdminStatusController;
use App\Http\Controllers\AdminController as AdminAdminController;
use App\Http\Controllers\Vendor\UpdateVendorBankController;
use App\Http\Controllers\Vendor\UpdateVendorBusinessController;
use App\Http\Controllers\Vendor\UpdateVendorDetailController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::get('/{page}', [AdminAdminController::class, 'index']);




Route::prefix('admin/')->name('admin.')->group(function () {

    Route::get('login-form',                            [AdminLoginController::class, 'loginForm'])->name('login.form');
    Route::post('login',                                [AdminLoginController::class, 'login'])->name('login');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('dashboard',                         [AdminLoginController::class, 'index'])->name('dashboard');
        Route::get('logout',                            [AdminLoginController::class, 'logout'])->name('logout');

        Route::view('profile',                          'admin.profile')->name('profile');
        Route::post('check-password',                   CheckPasswordController::class)->name('check_password');
        Route::put('update-details',                    UpdateDetailController::class)->name('update_details');
        Route::put('update-password',                   UpdatePasswordController::class)->name('update_password');


        // ======================
        // Admins
        // ======================
        Route::resource('admins',                       AdminController::class);
        Route::post('update-admin-status',              UpdateAdminStatusController::class);


        // ======================
        // Admins
        // ======================
        Route::resource('sections',                     SectionController::class);
        Route::post('update-section-status',            UpdateSectionStatusController::class);
    });
});
Route::prefix('vendor/')->name('vendor.')->group(function () {

    Route::view('profile',                              'admin.vendors.profile')->name('profile');
    Route::put('update-details',                       UpdateVendorDetailController::class)->name('peronsal-info.update');
    Route::put('update-business',                      UpdateVendorBusinessController::class)->name('business-info.update');
    Route::put('update-bank',                          UpdateVendorBankController::class)->name('bank-info.update');
});