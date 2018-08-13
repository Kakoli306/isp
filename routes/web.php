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

Route::group(['middleware'=>'role:superadmin'], function() {

Route::get('/superadminPage', 'SuperAdminController@index');
Route::get('/create-user', 'UserController@create')->name('create-user');
Route::post('/store-user', 'UserController@store')->name('user-store');



    Route::group(['prefix'=>'customer'], function() {
    Route::get('/create', 'CustomerController@create')->name('add-customer');
    Route::post('/new', 'CustomerController@save')->name('new-customer');

  });


});


Route::group(['middleware'=>'role:admin'], function() {

Route::get('/adminPage', 'SuperAdminController@index');
Route::get('/create-user', 'UserController@create')->name('create-user');
Route::post('/store-user', 'UserController@store')->name('user-store');


Route::group(['prefix'=>'customer'], function() {
Route::get('/create', 'CustomerController@create')->name('add-customer');
Route::post('/new', 'CustomerController@save')->name('new-customer');

});


});


Route::group(['middleware'=>'role:admin'], function() {

Route::get('/adminPage', 'SuperAdminController@index');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
