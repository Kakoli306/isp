@extends('superadmin.master')

@section('title')
    Edit User
@endsection
@section('content')

    <div class="card">

        <!-- Card image -->
        <div class="view overlay">

        </div>
        <div class="card-body">

            <h2 class="text-center text-success">{{Session::get('message')}}</h2>

            <form role="form" enctype="multipart/form-data" method="post" action="{{route('update-user')}}" >
                @csrf

                <input type="hidden"  name="userId" value="{{$userId->userId}}">



                <div class="row" style="padding:10px; font-size: 12px;">

                    <div class="col-md-6 col-md-offset-1">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Full Name</label>
                            <input type="text" name="full_name" class="form-control" id="exampleInputEmail1" value="{{$userId->fullname}}" placeholder="Full Name"  required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Name</label>
                            <input type="text" name="user_name" class="form-control" id="exampleInputEmail1" value="{{$userId->username}}" placeholder="User Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mobile No</label>
                            <input type="text" name="mobile_no" class="form-control" id="exampleInputEmail1" value="{{$userId->phone}}" placeholder="Mobile No" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address" value="{{$userId->email}}" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input class="form-control" name="address" rows="4" value="{{$userId->address}}" >
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



                        <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
