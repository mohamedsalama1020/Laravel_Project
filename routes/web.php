<?php

use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SocialController;




Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified');

Route::get('/redirect/{service}', [SocialController::class, 'redirect']);
Route::get('/callback/{service}', [SocialController::class, 'callback']);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath'
        ]
    ],
    function () {
        Route::group(['prefix' => 'offers'], function () {
            Route::get('create', [OfferController::class, 'create'])->name('offers.create');
            Route::post('store', [OfferController::class, 'store'])->name('offers.store');
            Route::get('show',[OfferController::class,'show']);
            Route::get('edit/{id}',[OfferController::class,'editOffer'])->name('offer.edit');
            Route::post('update/{id}', [OfferController::class, 'update'])->name('offers.update');

        });
    }
);
   

