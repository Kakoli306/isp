<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Role;
use App\Permission;
use App\User;

class UserController extends Controller
{
  public function create(){

  $roles= Role::all();
  $permissions= Permission::all();

return view('superadmin.user.createUser',compact('roles','permissions'));

  }




public function store(Request $request){

 ;

//return $request->all();

if(Input::file('profileImage') != null){
       $profileImage = Input::file('profileImage');
       $name = $profileImage->getClientOriginalName();
       $uploadPath = 'Image/';
       $profileImage->move($uploadPath, $name);
       $imageUrl = $uploadPath . $name;


        $user =    User::create([

               'fullname' => $request->full_name,
               'username' => $request->user_name,
               'email' => $request->email,
               'phone' => $request->mobile_no,
               'password' => bcrypt($request->password),
               'address' => $request->address,
               'status' => $request->status,
               'image' => $imageUrl,
           ]);

           $user->attachRole(Role::where('name',$request->user_type)->first());

           foreach ($request->WorkPermission as $permission) {

            $user->attachPermission(Permission::where('name',$request->WorkPermission)->first());
       }

          return redirect()->back()->with('message','User Create Successfully');
        }

        else{

          $user =    User::create([

                 'fullname' => $request->full_name,
                 'username' => $request->user_name,
                 'email' => $request->email,
                 'phone' => $request->mobile_no,
                 'password' => bcrypt($request->password),
                 'address' => $request->address,
                 'status' => $request->status,
             ]);

             $user->attachRole(Role::where('name',$request->user_type)->first());



             //dd($userrole);
            // foreach ($request->WorkPermission as $key=>$value){
//return $value;
                $user->permissions()->attach(Permission::where('name',$request->WorkPermission)->first());

        //  }

            return redirect()->back()->with('message','User Create Successfully');





        }




}



}
