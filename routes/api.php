<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\MstLokasiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [UserController::class, 'loginMobile']);
Route::post('/register', [UserController::class, 'registerMobile']);
Route::get('/user/avatar/{name}', [UserController::class,'get_avatar']);
// Route::post('resgister', [UserController::class, 'registerMobile']);
Route::group(['middleware' => 'jwt.verify'], function () {
    Route::post('/absenmasuk', [AbsensiController::class,'absenmasuk']);
    Route::post('/absenkeluar', [AbsensiController::class,'absenkeluar']);
    Route::get('/getabsen/{id}', [AbsensiController::class,'getabsen']);
    Route::get('/getdailyabsen/{id}', [AbsensiController::class,'getdailyabsen']);
    Route::get('/getlembur/{id}', [AbsensiController::class,'getlembur']);
    Route::post('/lokasi', [MstLokasiController::class,'getlokasi']);
    Route::get('/user', [UserController::class,'getAuthenticatedUser']);
    Route::post('/user/update', [UserController::class,'update']);
    // Route::get('/absensi/export/{id}',[AbsensiController::class,'exportExcelMobile'])->name('export.absensi');
});


// Route::get('/attendance/{id}', 'Api\AttendanceController@GetDetailOfAttendance');
// Route::get('/hrd/appointments/update/{booking_id}/{dokter_pengganti_id}', 'Api\AppointmentsController@UpdateAppointmentsFromHRD');