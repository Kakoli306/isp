<?php

namespace App\Providers;

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
           $user = Auth::user()->id;
            $role =  User::whereHas('roles', function($q){$q->whereIn('roles.id',['Auth::user()->id']);})->first();


        //dd($photographers);

        $view->with('role',$role);
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
