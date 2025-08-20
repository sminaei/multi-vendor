<?php

use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/seller', function () {
    return view('welcome');
});
Route::prefix('seller')->name('seller.')->group(function (){
    Route::middleware([])->group(function (){
        Route::controller(SellerController::class)->group(function ()
        {
            Route::get('/login','login')->name('login');
            Route::post('/login-handler','loginHandler')->name('login-handler');
            Route::get('/register','register')->name('register');
            Route::post('/create','createSeller')->name('create');
            Route::get('/account/verify/{token}','verifyAccount')->name('verify');
            Route::get('/register-success','registerSuccess')->name('register-success');

        });
    });
    Route::middleware([])->group(function (){
        Route::controller(SellerController::class)->group(function (){
            Route::get('/','home')->name('home');
            Route::post('/logout','logoutHandler')->name('logout');
        });
    });
});
