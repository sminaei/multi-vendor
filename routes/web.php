<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/example-page', 'example-page');
Route::view('/example-auth', 'example-auth');
Route::view('/example-frontend', 'example-frontend');
