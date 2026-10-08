<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KegiatanManageController;

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth.user')->group(function () {
    Route::get('/', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/status/{status}', [KegiatanController::class, 'filter'])->name('kegiatan.filter');
    Route::get('/akan-datang', [KegiatanController::class, 'akanDatang'])->name('kegiatan.akan');
    Route::get('/selesai', [KegiatanController::class, 'selesai'])->name('kegiatan.selesai');
    Route::get('/kalender', [KegiatanController::class, 'kalender'])->name('kegiatan.kalender');
    Route::get('/semua-kegiatan', [KegiatanController::class, 'semua'])->name('kegiatan.semua');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile.view');

    Route::middleware('admin')->group(function () {
        Route::get('/tambah', [KegiatanController::class, 'create'])->name('kegiatan.create');
        Route::post('/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('/edit/{id}', [KegiatanController::class, 'edit'])->whereNumber('id')->name('kegiatan.edit');
        Route::put('/update/{id}', [KegiatanController::class, 'update'])->whereNumber('id')->name('kegiatan.update');
        Route::delete('/delete/{id}', [KegiatanController::class, 'destroy'])->whereNumber('id')->name('kegiatan.destroy');

        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/kegiatan', [KegiatanManageController::class, 'index'])->name('admin.kegiatan.index');
        Route::delete('/admin/kegiatan/bulk', [KegiatanManageController::class, 'bulkDestroy'])->name('admin.kegiatan.bulk-destroy');
        Route::get('/admin/kegiatan/{kegiatan}/edit', [KegiatanManageController::class, 'edit'])->whereNumber('kegiatan')->name('admin.kegiatan.edit');
        Route::put('/admin/kegiatan/{kegiatan}', [KegiatanManageController::class, 'update'])->whereNumber('kegiatan')->name('admin.kegiatan.update');
        Route::delete('/admin/kegiatan/{kegiatan}', [KegiatanManageController::class, 'destroy'])->whereNumber('kegiatan')->name('admin.kegiatan.destroy');
    });
});