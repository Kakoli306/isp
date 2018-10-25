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


            //dd($user);

            $view->with('role',$role);


        });

        View::composer('superadmin.includes.aside', function ($view) {

            // Get the $data
            //  $customer = Customer::orderBy('id', 'desc')->get();

            $cus = Customer::count();
            $customer = $cus/2;

            $cust = Customer::orderBy('id', 'desc')->take($customer)->get();
            // $cust1 = Customer::orderBy('id', 'asc')->take($customer)->get();

            // dd($cust);

            $view->with('cust', $cust);


            // dd($customer);

        });

        View::composer('superadmin.includes.aside', function ($view) {

            // Get the $data
            //  $customer = Customer::orderBy('id', 'desc')->get();

            $cus = Customer::count();
            $customer = $cus/2;

            // $cust = Customer::orderBy('id', 'desc')->take($customer)->get();
            $cust1 = Customer::orderBy('id', 'asc')->take($customer)->get();

            // dd($cust);

            $view->with('cust1', $cust1);


            // dd($customer);

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
