<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\BantuanSosialController;
use App\Http\Controllers\MonitoringController;

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



//Route::get('/', function () {
 //   return view('welcome');
//});

Route::resource('bantuan_sosial', BantuanSosialController::class);
Route::get('/', [BantuanSosialController::class, 'create']);
Route::post('/bantuan_sosial', [BantuanSosialController::class, 'store'])->name('bantuan_sosial.store');


Route::get('/auth', [AuthController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/auth', [AuthController::class, 'index']);
Route::get('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/login', [AuthController::class, 'login']);

 // untuk menampilkan puskesmas dan create data

Route::get('/puskesmas', [PuskesmasController::class, 'index'])->name('puskesmas.index');
Route::post('/bantuan_sosial/{id}/status', [BantuanSosialController::class, 'updateStatus'])->name('bantuan_sosial.updateStatus');
Route::get('/puskesmas/{id}', [PuskesmasController::class, 'show'])->name('puskesmas.show');



Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');

Route::get('bantuan-sosial/{id}/export-pdf', [BantuanSosialController::class, 'exportToPdf']);

