<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KegiatanController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
/*
|--------------------------------------------------------------------------
| WEB ROUTES (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware([function ($request, $next) {
    if (!session()->has('user')) {
        return redirect('/login');
    }
    return $next($request);
}])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/', function () {
        return app(App\Http\Controllers\KegiatanController::class)->index();
    })->name('kegiatan.index');

    /*
    |--------------------------------------------------------------------------
    | Kegiatan Admin Routes (Hanya Admin: Ketua Himpunan, Wakil, Ketua Divisi)
    | REQ-F-24 & REQ-F-25
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])->group(function () {
        Route::get('/tambah', [KegiatanController::class, 'create'])->name('kegiatan.create');
        Route::post('/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('/edit/{id}', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
        Route::put('/update/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('/delete/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Fitur Pengguna Umum & Admin (REQ-F-26)
    | Melihat dashboard, daftar kegiatan, kalender, pencarian, notifikasi, profil
    |--------------------------------------------------------------------------
    */
    Route::get('/status/{status}', [KegiatanController::class, 'filter'])->name('kegiatan.filter');
    Route::get('/akan-datang', [KegiatanController::class, 'akanDatang'])->name('kegiatan.akan');
    Route::get('/selesai', [KegiatanController::class, 'selesai'])->name('kegiatan.selesai');
    Route::get('/kalender', [KegiatanController::class, 'kalender'])->name('kegiatan.kalender');
    Route::get('/semua-kegiatan', [KegiatanController::class, 'semua'])->name('kegiatan.semua');
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile.view');

});