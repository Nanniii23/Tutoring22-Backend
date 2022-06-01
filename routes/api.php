<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', [AuthController::class,'login']);

Route::get('offers',[OfferController::class,'index']);
Route::get('offers/{id}', [OfferController::class,'findById']);
Route::get('offers/search/{searchTerm}',
    [OfferController::class,'findBySearchTerm']);
Route::post('offers', [OfferController::class,'save']);
Route::put('offers/{id}', [OfferController::class,'update']);
Route::delete('offers/{id}', [OfferController::class,'delete']);

Route::put('appointments/change/{id}', [AppointmentController::class, 'changeAppointment']);
