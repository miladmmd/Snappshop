<?php

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\CreditCardController;
use Modules\Payment\Http\Controllers\TransactionController;
use Modules\Payment\Http\Middleware\ProcessPersianArabicNumbers;


/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::post('/p2p',[CreditCardController::class,'p2p'])->middleware(ProcessPersianArabicNumbers::class);
Route::get('/recentTransaction',[TransactionController::class,'recentTransaction'])->middleware(ProcessPersianArabicNumbers::class);
