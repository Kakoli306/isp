

@extends('superadmin.master')
@section('title')
isp-manager
@endsection
@section('content')

<div class="card">

  <!-- Card image -->
  <div class="view overlay">

     </div>
      <div class="card-body">
<form role="form" enctype="multipart/form-data" method="post" action="{{route('user-store')}}" >
  @csrf
                  <div class="row" style="padding:10px; font-size: 12px;">

                    <div class="col-md-6 col-md-offset-1">

                      <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="exampleInputEmail1" placeholder="Full Name" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input type="text" name="user_name" class="form-control" id="exampleInputEmail1" placeholder="User Name" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mobile No</label>
                        <input type="text" name="mobile_no" class="form-control" id="exampleInputEmail1" placeholder="Mobile No" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email Address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="**********" required>
                      </div>




                      <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <textarea class="form-control" name="address" rows="4"></textarea>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <img width="140" height="140" src="{{asset('superadmin/')}}/img/user.png" alt="" class="img-thumbnail" id="pre_photo">
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <label for="exampleInputFile">Chose Photo</label>
                            <input type="file" name="profileImage"   accept="image/*">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">User Status</label>
                        <select name="status" class="form-control" style="margin-bottom: 5px;" required>
                          <option value="1">Active</option>
                          <option value="0">InActive</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">User Type</label>
                        <select name="user_type" class="form-control" style="margin-bottom: 5px;" required>
                          <option value="">Select User Type</option>
                          @foreach($roles as $role)
                          <option value="{{$role->name}}">{{$role->name}}</option>

                          @endforeach

                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Permission</label>

                        <div class="form-group" style="border: 1px solid #CCCCCC; padding: 5px; border-radius:4px;">
                            @foreach($permissions as $permission)
                          <label class="checkbox-inline">
                            <input type="checkbox" name="WorkPermission[]" style="font-size: 12px;" class="wclschekbox" id="inlineCheckbox1" value="{{$permission->id}}" > {{$permission->name}}
                          </label>
                            @endforeach
                        </div>
                      </div>


                      <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                      </div>

                    </div>



                  </div>


                </form>
              </div>

             </div>

                @endsection
