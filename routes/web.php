<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PropertytypesController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdvertisementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', function () {
    return redirect('login');
});
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// Route::get('home', [DashboardController::class, 'index'])->name('home');

//state master
Route::resource('state', StateController::class)->middleware('auth');
Route::get('getStateIndexData', [StateController::class, 'getStateIndexData'])->name('getStateIndexData');
Route::post('getStateCityData', [StateController::class, 'getStateCityData'])->name('getStateCityData');
Route::post('getCityAreaData', [StateController::class, 'getCityAreaData'])->name('getCityAreaData');
Route::post('getStateCityAreaData', [StateController::class, 'getStateCityAreaData'])->name('getStateCityAreaData');

//city master
Route::resource('city', CityController::class)->middleware('auth');
Route::get('getCityIndexData', [CityController::class, 'getCityIndexData'])->name('getCityIndexData');

//area master
Route::resource('area', AreaController::class)->middleware('auth');
Route::get('getAreaIndexData', [AreaController::class, 'getAreaIndexData'])->name('getAreaIndexData');

//amenities master
Route::resource('amenities', AmenitiesController::class)->middleware('auth');
Route::get('getAmenitiesIndexData', [AmenitiesController::class, 'getAmenitiesIndexData'])->name('getAmenitiesIndexData');

//category master
Route::resource('category', CategoryController::class)->middleware('auth');
Route::get('getCategoryIndexData', [CategoryController::class, 'getCategoryIndexData'])->name('getCategoryIndexData');

//subcategory master
Route::resource('subcategory', SubcategoryController::class)->middleware('auth');
Route::get('getSubCategoryIndexData', [SubcategoryController::class, 'getSubCategoryIndexData'])->name('getSubCategoryIndexData');

//propertytypes master
Route::resource('propertytypes', PropertytypesController::class)->middleware('auth');
Route::get('getPropertytypesIndexData', [PropertytypesController::class, 'getPropertytypesIndexData'])->name('getPropertytypesIndexData');

Route::resource('property', PropertyController::class)->middleware('auth');
Route::resource('buyer', BuyerController::class)->middleware('auth');
Route::resource('seller', SellerController::class)->middleware('auth');
Route::resource('projects', ProjectsController::class)->middleware('auth');

// package routes
Route::resource('package', PackageController::class)->middleware('auth');
Route::get('getPackageIndexData', [PackageController::class, 'getPackageIndexData'])->name('getPackageIndexData');

Route::resource('review', ReviewController::class)->middleware('auth');
Route::resource('advertisement', AdvertisementController::class)->middleware('auth');

// settings routes
Route::resource('settings', SettingsController::class)->middleware('auth');
Route::put('settings/email_update/{id}', [SettingsController::class, 'email_update'])->name('settings.email_update')->middleware('auth');

// Route::resource('dashboard', DashboardController::class);


// Route::get('/Home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 //Route::get('/Login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
