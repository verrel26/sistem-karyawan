<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\LiputanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CutiController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('index');
});


Route::get('/', function () {
    // redirect ke halaman login jika belum login
    if (!Auth::check()) {
        return redirect('/login');
    }
    return view('/index');
});

// Route::get('/login', [LoginController::class, 'login']);

Auth::routes();
// HALAMAN USER
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::controller(RoleController::class)->prefix('role')->group(function () {
        Route::get('', 'index')->name('role.index');
        Route::get('data', 'data')->name('role.data');
        Route::post('store', 'store')->name('role.store');
        Route::put('update', 'update')->name('role.update');
        Route::delete('destroy', 'destroy')->name('role.destroy');
        Route::post('assign-permission', 'assignPermission')->name('role.assignPermission');
    });
    Route::controller(PermissionController::class)->prefix('permission')->group(function () {
        Route::get('', 'index')->name('permission.index');
        Route::get('data', 'data')->name('permission.data');
        Route::post('store', 'store')->name('permission.store');
        Route::put('update', 'update')->name('permission.update');
        Route::delete('destroy', 'destroy')->name('permission.destroy');
    });

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('', 'index')->name('user.index');
        Route::get('data', 'data')->name('user.data');
        Route::post('store', 'store')->name('user.store');
        Route::put('update', 'update')->name('user.update');
        Route::delete('destroy', 'destroy')->name('user.destroy');
    });
    Route::controller(KaryawanController::class)->prefix('karyawan')->group(function () {
        Route::get('', 'index')->name('karyawan.index');
        Route::get('data', 'data')->name('karyawan.data');
        Route::post('store', 'store')->name('karyawan.store');
        Route::put('update', 'update')->name('karyawan.update');
        Route::delete('destroy', 'destroy')->name('karyawan.destroy');
        Route::get('show/{id}', 'show')->name('karyawan.show');
    });
    Route::controller(CutiController::class)->prefix('cuti')->group(function () {
        Route::get('', 'index')->name('cuti.index');
        Route::get('data', 'data')->name('cuti.data');
        Route::post('store', 'store')->name('cuti.store');
        Route::put('update', 'update')->name('cuti.update');
        Route::delete('destroy', 'destroy')->name('cuti.destroy');
        Route::get('show/{id}', 'show')->name('cuti.show');
        Route::get('terima', 'terima')->name('cuti.terima');
        Route::get('tolak', 'tolak')->name('cuti.tolak');
        Route::get('pengajuan', 'pengajuan')->name('cuti.pengajuan');
    });
    Route::controller(LemburController::class)->prefix('lembur')->group(function () {
        Route::get('', 'index')->name('lembur.index');
        Route::get('data', 'data')->name('lembur.data');
        Route::post('store', 'store')->name('lembur.store');
        Route::put('update', 'update')->name('lembur.update');
        Route::delete('destroy', 'destroy')->name('lembur.destroy');
        Route::get('show/{id}', 'show')->name('lembur.show');
    });
    Route::controller(LiputanController::class)->prefix('liputan')->group(function () {
        Route::get('', 'index')->name('liputan.index');
        Route::get('data', 'data')->name('liputan.data');
        Route::post('store', 'store')->name('liputan.store');
        Route::put('update', 'update')->name('liputan.update');
        Route::delete('destroy', 'destroy')->name('liputan.destroy');
        Route::get('show/{id}', 'show')->name('liputan.show');
    });
});
// HALAMAN USER
