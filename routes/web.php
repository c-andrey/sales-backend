<?php

use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'sellers'], function () {
        Route::post('/', [SellerController::class, 'store']);
        Route::get('/', [SellerController::class, 'index']);
        Route::get('/{seller}', [SellerController::class, 'show']);
        Route::put('/{seller}', [SellerController::class, 'update']);
        Route::delete('/{seller}', [SellerController::class, 'destroy']);
    });

    Route::group(['prefix' => 'sales'], function () {
        Route::post('/', [SaleController::class, 'store']);
        Route::get('/', [SaleController::class, 'index']);
        Route::get('/{sale}', [SaleController::class, 'show']);
        Route::put('/{sale}', [SaleController::class, 'update']);
        Route::delete('/{sale}', [SaleController::class, 'destroy']);
    });
});
