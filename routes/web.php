<?php

use App\User;

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

Auth::routes();

Route::group(['middleware'=>'auth'], function() {

    Route::get('/superadminPage', 'SuperAdminController@index');


    Route::group(['middleware' => 'role:superadmin'], function () {

        Route::get('/superadminPage', 'SuperAdminController@index');

    });

    Route::group(['middleware' => 'role:admin'], function () {

        Route::get('/adminPage', 'SuperAdminController@index');
    });

    Route::group(['middleware' => 'role:superadmin||admin'], function () {
        Route::get('/create-user', 'UserController@create')->name('create-user');
        Route::post('/store-user', 'UserController@store')->name('user-store');
        Route::get('/manage-user', 'UserController@show')->name('user-show');

        Route::get('/changePassword', 'UserController@showChangePasswordForm')->name('ch');
        Route::post('/changePassword', 'UserController@changePassword')->name('changePassword');
        Route::get('/details/{id}', 'UserController@details')->name('user-details');
        Route::get('/user/edit/{id}', 'UserController@edit');
        Route::post('/update', 'UserController@update')->name('update-user');
        Route::post('/delete', 'UserController@deleteUser')->name('delete-user');

    });


//customer
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/create', 'CustomerController@create')->name('add-customer');
        Route::post('/new', 'CustomerController@save')->name('new-customer');
        Route::get('/manage', 'CustomerController@manageCustomer')->name('manage-customer');
        Route::get('/inactive/{id}', 'CustomerController@inactiveCustomer')->name('inactive-customer');
        Route::get('/active/{id}', 'CustomerController@activeCustomer')->name('active-customer');
        Route::get('/edit/{id}', 'CustomerController@editCustomer')->name('edit');
        Route::post('/update', 'CustomerController@updateCustomer')->name('update');
        Route::get('/delete/{id}', 'CustomerController@deleteCustomer')->name('delete');

        Route::get('/actives', 'LiveSearchController@actives')->name('show-actives');
        Route::get('/inactive', 'LiveSearchController@inactive')->name('show-inactives');
        Route::get('/current', 'CustomerController@current')->name('yes');
        Route::get('/discount', 'CustomerController@discount')->name('discount');

    });
//search
    Route::get('/search/action', 'CustomerController@action')->name('search.action');
    Route::get('/sea', 'ZoneController@search')->name('sea');
    Route::get('/act', 'LiveSearchController@action')->name('action');
    Route::get('/search', 'UserController@result')->name('search');
    Route::get('/un/act', 'LiveSearchController@unactive')->name('unse');
    Route::get('/bse', 'NewController@search')->name('bse');
    Route::get('/abs', 'NewController@searchabs')->name('abs');
    Route::post('filt', 'LiveSearchController@filterByDate')->name('filter-by-date');
    Route::post('/filter', 'NewController@filter')->name('filter');
    Route::post('/fd', 'CustomerController@filter')->name('fdl');
    Route::post('/cdl', 'IncomeController@filter')->name('cdl');
    Route::post('/idfiter', 'IncomeController@idfiter')->name('idfiter');
    Route::post('/psearch', 'NewController@psearch')->name('psearch');
    Route::get('/billsearch', 'BillingController@billsearch')->name('billsearch');
    Route::get('/aside', 'CustomerController@aside')->name('aside');


    Route::get('/charge', 'CustomerController@charge')->name('connection');

    Route::get('/billing', 'BillingController@add')->name('index');
    Route::get('/billing/edit/{id}', 'BillingController@editBilling')->name('edit-billing');
    Route::post('billing/add/{id}', 'BillingController@adding')->name('add-billing');
    Route::get('/billing/edit/{id}/amount', 'BillingController@editAmount')->name('edit-amount');
    Route::post('/billing/update', 'BillingController@updateBilling')->name('update-billing');
    Route::post('/billing/delete', 'BillingController@deleteBilling')->name('delete-billing');
    Route::post('/billing/paid', 'BillingController@paid')->name('show-paid');
    Route::post('/billing/unpaid', 'BillingController@unpaid')->name('show-unpaid');
    Route::get('/discount', 'BillingController@discount')->name('discount');
    Route::get('/paid', 'NewController@paid')->name('paid_customer');
    Route::get('/unpaid', 'NewController@unpaid')->name('unpaid_customer');
    Route::get('/billing/showing/{id}', 'BillingController@showBilling');


    Route::get('/monthly', 'NewController@monthly')->name('monthly');
    Route::get('/yearly', 'SuperAdminController@yearly')->name('yearly');
    Route::get('/new/month/{id}', 'SuperAdminController@new');


    Route::get('/account_statement', 'NewController@statement')->name('statement');
    Route::get('/billing/show/{id}', 'NewController@showBilling')->name('show-billing');
    Route::get('/daily/date/{id}', 'NewController@daily');
    Route::get('/con/date/{id}', 'NewController@con');
    Route::get('/inc/date/{id}', 'NewController@inc');
    Route::get('/exp/date/{id}', 'NewController@exp');

    Route::get('/product/view/{id}', 'NewController@product');

    Route::get('/income_report', 'NewController@report')->name('inc_report');

//Head
    Route::get('/product', 'ProductController@index');
    Route::get('product/{product_id?}', 'ProductController@show');
    Route::post('product', 'ProductController@store');
    Route::put('product/{product_id}', 'ProductController@update');
    Route::delete('product/{product_id}', 'ProductController@destroy');

//Income
    Route::resource('income', 'IncomeController');

//zone
    Route::get('/zone', 'ZoneController@index');
    Route::get('zone/{zone_id?}', 'ZoneController@show');
    Route::post('zone', 'ZoneController@store');
    Route::post('zoneStore', 'ZoneController@storeZone');

    Route::put('zone/{zone_id}', 'ZoneController@update');
    Route::delete('zone/{zone_id}', 'ZoneController@destroy');

//Expense
//Display Index Page
    Route::resource('expenses', 'ExpenseController');
    Route::get('/head/show/{id}', 'SuperAdminController@headshow')->name('head-show');
    Route::get('/exp_report', 'ExpenseController@report')->name('expense_report');
    Route::get('/downloadPDF/{id}', array('as' => 'pdfview', 'uses' => 'SuperAdminController@downloadPDF'));
    Route::get('/download/{id}', 'SuperAdminController@download');

//chart
    Route::get('/chart', 'SuperAdminController@newchart');
    Route::get('/bar-chart', 'SuperAdminController@mychart');


//sms
    Route::get('/smspage', 'SmsController@page');
    Route::post('/sms', 'SmsController@sendSms');

    Route::get('importExport', 'ExcelController@importExport');
// Route for export/download tabledata to .csv, .xls or .xlsx
    Route::get('downloadExcel/{type}', 'ExcelController@downloadExcel');
// Route for import excel data to database.
    Route::post('importExcel', 'ExcelController@importExcel');

});




