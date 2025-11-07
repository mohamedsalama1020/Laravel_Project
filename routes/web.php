<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\CustomController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Relations;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\RelationsController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\VideoController;
use Illuminate\Database\Eloquent\Relations\Relation;
define('PAGINATION_COUNT',10);
 
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
############################################
// offers
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
            Route::get('showPagination',[CrudController::class,'show'])->name('offers.showPagination');
            Route::get('getValidOffers',[CrudController::class,'valid_offers']);
            Route::get('accessors',[CrudController::class,'get_Offers']);


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
// middlewares 
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

#################################################
// Relation
Route::get('hasone',[RelationsController::class,'has_one']);
Route::get('hasonerev',[RelationsController::class,'has_one_rev']);
Route::get('hasphone',[RelationsController::class,'user_has_phone']);
Route::get('nothasphone',[RelationsController::class,'user_notHas_phone']);
Route::get('gethospitaldocators',[RelationsController::class,'getHospitalDocators']);
Route::get('doctors/{hospital_id}',[RelationsController::class,'doctors'])->name('doctors');
Route::get('hospitals',[RelationsController::class,'hospitals']);
Route::get('hospitals_has_doctors',[RelationsController::class,'hospitalsHasDoctors']);
Route::get('hospitals_has_doctor_male',[RelationsController::class,'doctors_male']);
Route::get('hospitals_not_has_doctors',[RelationsController::class,'hospitalsNotHasDoctors']);
Route::get('hospitals/{hospital_id}',[RelationsController::class,'delete_hospitals'])->name('delete');
Route::get('doctors_sevices',[RelationsController::class,'getDoctors_services']);
Route::get('sevices_doctors',[RelationsController::class,'getServices_doctors']);
Route::get('show-specialties/{doctor_id}',[RelationsController::class,'show_specialties'])->name('specialties');
Route::post('add-specialties',[RelationsController::class,'add_specialties'])->name('addspecialties');
Route::get('patient-doctor',[RelationsController::class,'getPatientDoctor']);
Route::get('country-doctors',[RelationsController::class,'getHospitalDoctors']);