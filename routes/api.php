<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::post('/login', [App\Http\Controllers\Api\LoginController::class, 'login']);
    Route::get('state-list', [App\Http\Controllers\Api\MasterController::class,'stateList']);
    Route::get('city-list', [App\Http\Controllers\Api\MasterController::class,'cityList']);
    Route::get('area-list', [App\Http\Controllers\Api\MasterController::class,'areaList']);
    Route::get('subcategory-list', [App\Http\Controllers\Api\MasterController::class,'subCategoryList']);
    Route::get('propertytypes-list', [App\Http\Controllers\Api\MasterController::class,'PropertyTypesList']);
    Route::get('amenities-list', [App\Http\Controllers\Api\MasterController::class,'amenitiesList']);
    Route::get('package-list', [App\Http\Controllers\Api\MasterController::class,'packageList']);
    Route::get('emailsettings-list', [App\Http\Controllers\Api\MasterController::class,'emailSettingsList']);
    Route::get('settings-list', [App\Http\Controllers\Api\MasterController::class,'settingsList']);

   
    // Route::post('users-details',[ App\Http\Controllers\Api\UserController::class,'store']);
    Route::resource('users', App\Http\Controllers\Api\UserController::class);
    Route::resource('builder', App\Http\Controllers\Api\BuilderController::class);
    Route::resource('project-details', App\Http\Controllers\Api\ProjectdetailsController::class);



});

