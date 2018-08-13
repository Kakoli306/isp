<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
               [
                   'name' => 'view',
                   'display_name' => 'Display Post Listing',
                   'description' => 'See only Listing Of Post'
               ],
               [
                   'name' => 'add',
                   'display_name' => 'Create Post',
                   'description' => 'Create New Post'
               ],
               [
                   'name' => 'edit',
                   'display_name' => 'Edit Post',
                   'description' => 'Edit Post'
               ],
               [
                   'name' => 'delete',
                   'display_name' => 'Delete Post',
                   'description' => 'Delete Post'
               ],



       ];

       foreach ($permissions as $key=>$value){
        Permission::create($value);
       }

    }
}
