<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// admin



Route::middleware('role:admin')->group(function(){
	//Route::get('/', 'AdminController@dashboard')->name('dashboardpage');
	Route::get('dashboard', 'AdminController@dashboard')->name('dashboardpage');
	Route::get('vendordashboard', 'VendorController@dashboard')->name('vendordashboard');

});

// admin
Route::resource('role','RoleController');
Route::resource('restaurantInfos','RestaurantInfoController');
Route::resource('staff','StaffController');


Route::resource('menu_categories','MenuCategoryController');

Route::middleware('role:vendor')->group(function(){
	Route::get('vendordashboard', 'VendorController@dashboard')->name('vendordashboard');
});

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
