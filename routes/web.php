<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\CustomController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\VideoController;

Route::get('/', action: function () {
    return view('welcome');
});

Route::get('/dashboard', action: function () {
    return 'not adult!';
})->name('dashboard');

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
            Route::get('create', [CrudController::class, 'create'])->name('offers.create');
            Route::post('store', [CrudController::class, 'store'])->name('offers.store');
            Route::get('show',[CrudController::class,'show'])->name('offers.show');
            Route::get('edit/{id}',[CrudController::class,'editOffer'])->name('offer.edit');
            Route::post('update/{id}', [CrudController::class, 'update'])->name('offers.update');
            Route::get('delete/{id}', [CrudController::class,'delete'] )->name('offer.delete');
                
            });
        });
    
;
Route::get('youtube',[VideoController::class,'getVideo']  )->middleware('auth');

##################################################
// Ajax 


Route::group(['prefix'=>'ajax'],function(){

Route::get('create', [OfferController::class,'create'] );
Route::post('save',[OfferController::class,'save'])->name('ajax.save');
Route::get('show',[OfferController::class,'show'])->name('ajax.show');
Route::post('delete',[OfferController::class,'delete'])->name('ajax.delete');

Route::get('edit/{offer_id}',[OfferController::class,'edit'])->name('ajax.edit');
Route::post('update',[OfferController::class,'update'])->name('ajax.update');

});
###################################################
Route::get('adults',[CustomController::class,'adults'])->middleware('CheckAge');

Route::get('site',[CustomController::class,'site'])->middleware('auth')->name('site');
Route::get('admin',[CustomController::class,'admin'])->middleware('auth:admin')->name('admin');
Route::group(['prefix'=>'admin'],function(){
Route::get('register',[AdminController::class,'admin_register'])->name('admin.register');
Route::post('register',[AdminController::class,'register'])->name('admin.register');
Route::get('login',[AdminController::class,'admin_login'])->name('admin.login');
Route::post('login',[AdminController::class,'adminLogin'])->name('admin.login');
Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');



});