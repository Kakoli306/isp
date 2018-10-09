<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Role;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
               // $user->permissions()->attach(Permission::where('name',$request->WorkPermission)->first());

          }

            return redirect()->back()->with('message','User Created Successfully');
        }

      public function show(){

          $users = User::paginate(3);

          return view('superadmin.user.showUser',['users'=> $users])
              ->with('i', (request()->input('page', 1) - 1) * 5);
      }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChangePasswordForm(){
        return view('superadmin.user.changepassword');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
// The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
//Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
//Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }


    public function details($id){
        $userId = User::where('userId', '=',$id)->first();
        return view('superadmin.user.userdetails',['userId'=> $userId]);
    }

    public function edit($id){

        $userId = User::where('userId',$id)->first();
        $roles = Role::all();
        $permissions = Permission::all();
        //dd($userId);
        return view('superadmin.user.editUser',compact('userId','roles','permissions'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->userId);
       // return $request->all();
       // dd($user);

        $user->fullname = $request->full_name;
        $user->username = $request->user_name;
        $user->phone = $request->mobile_no;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->save();

        return redirect('/manage-user')->with('message','this info updated successfully');
    }
    public function deleteUser(Request $request)
    {
        $user = User::find($request->userId);
        $user->delete();

        return redirect('manage-user')->with('success',' deleted successfully');
    }

   /* public function ajaxData(Request $request){

      return $request;

        $query = $request->get('query','');

        $users = User::where('username','LIKE','%'.$query.'%')->get();

        return response()->json($users);

    }*/

    public function autocomplete(Request $request)
    {
        $data = User::select("username")
            ->where("username","LIKE","%{$request->input('query')}%")
            ->get();

        return response()->json($data);
    }




}
