<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  $roles=[
             [
                 'name' => 'superadmin',
                 'display_name' => 'SuperAdmin',
                 'description' => 'superadmin'
             ],

             [
                 'name' => 'admin',
                 'display_name' => 'Admin',
                 'description' => 'admin'
             ],

             [
                 'name' => 'user',
                 'display_name' => 'user',
                 'description' => 'user'
             ],




     ];

     foreach ($roles as $key=>$value){
      Role::create($value);
     }
}

}
