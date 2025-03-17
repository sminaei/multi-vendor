<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function (){
        Route::middleware(['guest:admin','preventBackHistory'])->group(function(){
            Route::view('/login','back.pages.admin.auth.login')->name('login');
            Route::post('/login_handler',[AdminController::class,'loginHandler'])->name('login_handler');
        });
    Route::middleware(['auth:admin','preventBackHistory'])->group(function(){
        Route::view('/home','back.pages.admin.home')->name('home');
        Route::post('/logout_handler',[AdminController::class,'logoutHandler'])->name('logout_handler');
});

});
