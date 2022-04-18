<?php

use App\Http\Controllers\CommissionFeeController;
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


Route::get('/', [CommissionFeeController::class, 'create']);
Route::post('/transactions', [CommissionFeeController::class, 'storeWeb']);

