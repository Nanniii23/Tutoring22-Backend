<?php

use App\Http\Controllers\OfferController;
use App\Models\Offer;
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

Route::get('/', [OfferController::class,'index']);
Route::get('/offers', [OfferController::class,'index']);
Route::get('/offers/{offer}', [OfferController::class,'show']);


