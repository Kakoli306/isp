<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          User::truncate();

        User::create([

        	'fullname'=>'superadmin',
        	'username'=>'superadmin',
        	'email'=>'superadmin@gmail.com',
        	'phone'=>'+881234567890',
        	'photo'=>'',
        	'address'=>'Dhaka,Bd',
        	'status'=>'1',
        	'password'=> Hash::make('123456'),

        	]);





    }
}
