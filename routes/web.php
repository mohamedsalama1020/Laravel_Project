<?php

use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/redirect/{service}',[SocialController::class,'redirect']);
Route::get('/callback/{service}',[SocialController::class,'callback']);