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

        $view->with('role',$role);});

        view()->composer('superadmin.includes.aside', function ($view) {

            // Get the $data
            $customer = Customer::orderBy('id', 'desc')->get();

            $view->with('customer', $customer);
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
