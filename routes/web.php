<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;

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

Route::get('/login', [AuthController::class, 'loginView'])->middleware('guest')->name('login.view');
Route::post('/login', [AuthController::class, 'loginProcess'])->middleware('guest')->name('login.process');
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/siswa', SiswaController::class)->except('create','edit');
    Route::resource('/guru', GuruController::class)->except('create','edit');
    Route::resource('/mapel', MapelController::class)->except('create','edit');
    Route::resource('/user', UserController::class)->except('create','edit');
    Route::resource('/jadwal', JadwalController::class)->except('edit', 'show');
    Route::post('/jadwal/storesecond', [JadwalController::class, 'store_second'])->name('jadwal.storesecond');
});