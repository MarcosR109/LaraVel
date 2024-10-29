<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::get('user/{user}', 'show');
    Route::get('user/{user}/address', 'show_address');
});
Route::controller(AddressController::class)->group(function() {
    Route::post('store', 'store');
    Route::get('address/{address}', 'show');
    Route::get('address/{address}/user', 'show_user');
});
