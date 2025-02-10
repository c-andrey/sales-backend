<?php

use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    Route::post('/sellers', [SellerController::class, 'store']);
    Route::put('/sellers/{seller}', [SellerController::class, 'update']);
    Route::get('/sellers/{seller}', [SellerController::class, 'show']);
    Route::get('/sellers', [SellerController::class, 'index']);
    Route::delete('/sellers/{seller}', [SellerController::class, 'destroy']);
});
