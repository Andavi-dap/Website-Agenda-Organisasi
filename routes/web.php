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

// WEB ROUTES (must be logged in)
Route::get('/', [KegiatanController::class, 'index'])->name('kegiatan.index');

// ADMIN ROUTES
Route::middleware(['admin'])->group(function () {
    // Kegiatan CRUD (existing)
    Route::get('/tambah', [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::post('/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('/edit/{id}', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::put('/update/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/delete/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    // Admin dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Admin Kegiatan management (full CRUD)
    Route::get('/admin/kegiatan',                        [KegiatanManageController::class, 'index'])->name('admin.kegiatan.index');
    Route::get('/admin/kegiatan/create',                 [KegiatanManageController::class, 'create'])->name('admin.kegiatan.create');
    Route::post('/admin/kegiatan',                       [KegiatanManageController::class, 'store'])->name('admin.kegiatan.store');
    Route::get('/admin/kegiatan/{kegiatan}',             [KegiatanManageController::class, 'show'])->name('admin.kegiatan.show');
    Route::get('/admin/kegiatan/{kegiatan}/edit',        [KegiatanManageController::class, 'edit'])->name('admin.kegiatan.edit');
    Route::put('/admin/kegiatan/{kegiatan}',             [KegiatanManageController::class, 'update'])->name('admin.kegiatan.update');
    Route::delete('/admin/kegiatan/{kegiatan}',          [KegiatanManageController::class, 'destroy'])->name('admin.kegiatan.destroy');
    Route::delete('/admin/kegiatan/bulk',                [KegiatanManageController::class, 'bulkDestroy'])->name('admin.kegiatan.bulk-destroy');
});

// Additional routes
Route::get('/status/{status}', [KegiatanController::class, 'filter'])->name('kegiatan.filter');
Route::get('/akan-datang', [KegiatanController::class, 'akanDatang'])->name('kegiatan.akan');
Route::get('/selesai', [KegiatanController::class, 'selesai'])->name('kegiatan.selesai');
Route::get('/kalender', [KegiatanController::class, 'kalender'])->name('kegiatan.kalender');
Route::get('/semua-kegiatan', [KegiatanController::class, 'semua'])->name('kegiatan.semua');

Route::get('/profile', function () {
    return view('profile');
})->name('profile.view');