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

Route::get('/', 'Auth\LoginController@showLoginForm');

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


// vendor
Route::resource('menu_categories','MenuCategoryController');
Route::resource('expense_categories','ExpenseCategoryController');
Route::resource('table_infos','TableInfoController');
Route::resource('expenses','ExpenseController');
Route::resource('menu_items','MenuItemController');


Route::middleware('role:vendor')->group(function(){
	Route::get('vendordashboard', 'VendorController@dashboard')->name('vendordashboard');

});

Route::middleware('role:waiter')->group(function(){
	Route::get('waiterdashboard', 'WaiterController@dashboard')->name('waiterdashboard');
	Route::get('tableno/{id}/{menuCategoryid}', 'WaiterController@tableno')->name('tableno');
	

	Route::get('tableorderdisplay/{id}', 'WaiterController@tableorderdisplay')->name('tableorderdisplay');
	
});

Route::middleware('role:chef')->group(function(){
	Route::get('chefdashboard', 'ChefController@dashboard')->name('chefdashboard');
	Route::get('cheforderdetail/{id}', 'ChefController@cheforderdetail')->name('cheforderdetail');
});

Route::middleware('role:barcounterstaff')->group(function(){
	Route::get('barcounterstaffdashboard', 'BarcounterstaffController@dashboard')->name('barcounterstaffdashboard');
	Route::get('barorderdetail/{id}', 'BarcounterstaffController@barorderdetail')->name('barorderdetail');
});


Route::middleware('role:cashier')->group(function(){

	Route::get('cashierdashboard', 'CashierController@dashboard')->name('cashierdashboard');
	Route::get('cashierdetail/{id}', 'CashierController@cashierdetail')->name('cashierdetail');
	Route::get('cashierdetailprint/{id}', 'CashierController@cashierdetailprint')->name('cashierdetailprint');
});



//order
Route::resource('orders','OrderController');
Route::get('confirm/{orderid}/{menuid}/{status}','OrderController@confirm')->name('orders_confirm');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

