<?php

namespace App\Providers;

use App\Customer;
use Illuminate\Support\ServiceProvider;
use Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


        View::composer('superadmin.includes.header',function($view){
            //$user = Auth::user()->userId;
            $role =  User::whereHas('roles', function($q){$q->whereIn('roles.id',['Auth::user()->userId']);})->first();
            $view->with('role',$role);


        });

        View::composer('superadmin.includes.aside', function ($view) {


            $cus = Customer::count();
            $customer = (($cus+1)/2);

            $cust = Customer::orderBy('id', 'desc')->take($customer)->get();
            $view->with('cust', $cust);

        });




        View::composer('superadmin.includes.aside', function ($view) {

            $cus = Customer::count();
            $customer = (($cus+1)/2);
            $right_customer = $customer -1;

            $cust1 = Customer::orderBy('id', 'asc')->take($right_customer)->get();
            $view->with('cust1', $cust1);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
