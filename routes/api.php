<?php

use App\Http\Controllers\RequestApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route untuk api dummy
Route::get('post/data/pasien', [RequestApiController::class, 'postDataPatient'])->name('post/data.pasien');
Route::get('get/data/pasien', [RequestApiController::class, 'getDataByNik'])->name('get/data.pasien');
Route::get('get/riwayat/pengobatan', [RequestApiController::class, 'getRiwayatByRm'])->name('get/riwayat.pengobatan');
