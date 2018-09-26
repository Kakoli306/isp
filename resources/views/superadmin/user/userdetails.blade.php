@extends('superadmin.master')

@section('title')
    User Details
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 " >
                <div class="panel-group">
                    <!--Dashboard Section-->
                    <div class="panel panel-default">
                        <div class="panel-heading" id="" > <i class="fa fa-user"></i> <SPAN>Profile</SPAN>
                        </div>

                        <div class="panel-body" id="testApp">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="well well-sm">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-5" >
                                                <div style="text-align: center; margin-top: 10px;">

                                                    <img src="{{$userId->photo}}" alt="User Image" width="150" height="150">
                                                </div>

                                                <table class="table" >
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>:</td>
                                                        <td>{{$userId->fullname}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>E-mail</td>
                                                        <td>:</td>
                                                        <td>{{$userId->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status</td>
                                                        <td>:</td>
                                                        <td>{{$userId->status}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Phone</td>
                                                        <td>:</td>
                                                        <td>{{$userId->phone}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Address</td>
                                                        <td>:</td>
                                                        <td>{{$userId->address}}</td>
                                                    </tr>

                                                    <h4 class="mb-3">Entry By :
                                                    </h4>

                                                    <tr>
                                                        <td>Address</td>
                                                        <td>:</td>
                                                        <td>{{$userId->created_at}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Address</td>
                                                        <td>:</td>
                                                        <td>{{$userId->updated_at}}</td>
                                                    </tr>



                                                </table>

                                                <div class="text-right" style="margin-bottom:5px;">
                                                    <a href="{{ route('user-show') }}" type="button" class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i>Back</a>
                                                    <a href="{{ route('ch') }}" type="button" class="btn btn-success btn-sm" ><i class="fa fa-lock" aria-hidden="true"></i> Change Your Password</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>

@endsection