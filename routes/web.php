<?php

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

Route::get('/', function () {
    return view('welcome');
});
//
// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/login', 'Auth\LoginController@login');
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

//Route::group(['middleware'=>'role:superadmin'], function() {

Route::get('/superadminPage', 'SuperAdminController@index');
Route::get('/create-user', 'UserController@create')->name('create-user');
Route::post('/store-user', 'UserController@store')->name('user-store');

Route::group(['middleware'=>'role:admin'], function() {

Route::get('/adminPage', 'SuperAdminController@index');
Route::get('/create-user', 'UserController@create')->name('create-user');
Route::post('/store-user', 'UserController@store')->name('user-store');

});

    Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


//customer
Route::group(['prefix'=>'customer'], function() {
    Route::get('/create', 'CustomerController@create')->name('add-customer');
    Route::post('/new', 'CustomerController@save')->name('new-customer');
    Route::get('/manage', 'CustomerController@manageCustomer')->name('manage-customer');
    Route::post('/inactive/{id}', 'CustomerController@inactiveCustomer')->name('inactive-customer');
    Route::post('/active/{id}', 'CustomerController@activeCustomer')->name('active-customer');
    Route::get('/edit/{id}', 'CustomerController@editCustomer')->name('edit');
    Route::post('/update', 'CustomerController@updateCustomer')->name('update');
    Route::post('/delete', 'CustomerController@deleteCustomer')->name('delete');

    Route::get('/actives', 'CustomerController@actives')->name('show-actives');
    Route::get('/inactive', 'CustomerController@inactive')->name('show-inactives');
    Route::get('/current', 'CustomerController@current')->name('yes');
    Route::get('/discount', 'CustomerController@discount')->name('discount');
});

Route::get('/charge', 'CustomerController@charge')->name('connection');

Route::get('/billing', 'BillingController@add')->name('index');
Route::get('/billing/edit/{id}', 'BillingController@editBilling')->name('edit-billing');
Route::post('/save', 'BillingController@store')->name('bill_cat');
Route::post('/billing/update', 'BillingController@updateBilling')->name('update-billing');
Route::post('/billing/delete', 'BillingController@deleteBilling')->name('delete-billing');

//Head
Route::get('/product', 'ProductController@index');
Route::get('product/{product_id?}', 'ProductController@show');
Route::post('product', 'ProductController@store');
Route::put('product/{product_id}', 'ProductController@update');
Route::delete('product/{product_id}', 'ProductController@destroy');

//Income
Route::resource('income','IncomeController');

//zone
Route::get('/zone', 'ZoneController@index');
Route::get('zone/{zone_id?}', 'ZoneController@show');
Route::post('zone', 'ZoneController@store');
Route::put('zone/{zone_id}', 'ZoneController@update');
Route::delete('zone/{zone_id}', 'ZoneController@destroy');

//Expense
//Display Index Page
Route::get('/expense', 'ExpenseController@index');
Route::get('expense/{expense_id?}', 'ExpenseController@show');
Route::post('expense', 'ExpenseController@store');
Route::put('expense/{expense_id}', 'ExpenseController@update');
Route::delete('expense/{expense_id}', 'ExpenseController@destroy');

Route::get('/exp_report', 'ExpenseController@report')->name('expense_report');

