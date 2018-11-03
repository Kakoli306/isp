@extends('superadmin.master')

@section('title')
    Edit Customer
    @endsection
@section('content')

    <div class="card">
        <div class="view overlay">
            <div class="card-body">

                <h2 class="text-center text-success">{{Session::get('message')}}</h2>

                <form  method="post" action="{{ route('update')}}">
                    {{ csrf_field() }}

                    <input type="hidden"  name="customer_id" value="{{$customerById->id}}">

                    <div class="row" style="padding:10px; font-size: 12px;">

                        <div class="col-md-6 col-md-offset-1">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Customer Name</label>
                                <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" placeholder="Full Name" value="{{$customerById->customer_name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMobile1">Mobile Number</label>
                                <input type="number" name="mobile_no" class="form-control" id="exampleInputnumber" placeholder="Mobile No" value="{{$customerById->mobile_no}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email Address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address" value="{{$customerById->email}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Blood Group</label>
                                <input type="text" name="blood_group" class="form-control" id="exampleInputEmail1" placeholder="Email Address" value="{{$customerById->blood_group}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">National Id</label>
                                <input type="text" name="national_id" class="form-control" id="Inputnational_id" placeholder="National Id" value="{{$customerById->national_id}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Occupation</label>
                                <input type="text" name="occupation" class="form-control" id="Inputoccupation" placeholder="Occupation" value="{{$customerById->occupation}}">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control"  name="address"  rows="4" value="{{$customerById->address}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Zone</label><a class="btn btn-default" style="padding: 0px 6px;font-size: 12px;
                                    float:right;"href="" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-plus">Add Zone</i></a>
                                <select id="zone_id" type="zone_id" class="form-control"
                                        name="zone_id" value="{{$customerById->zone_id}}" required>
                                    @foreach ($zone as $value)
                                        <option value="{{$value->id}}" > {{$value->zone_name}}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Month Amount</label>
                                <input type="float" name="month_amount" class="form-control" id="month_amount" placeholder="Month Amount" value="{{$customerById->month_amount}}">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Bill Amount</label>
                                <input type="float" name="bill_amount" class="form-control" id="bill_amount" placeholder="Bill Amount" value="{{$customerById->bill_amount}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Connection Charge</label>
                                <input type="string" name="connection_charge" class="form-control" id="connection_charge" placeholder="Connection Charge" value="{{$customerById->connection_charge}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">IP Address</label>
                                <input type="string" name="ip_address" class="form-control" id="ip_address" placeholder="IP Address" value="{{$customerById->ip_address}}" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Connection Date</label>
                                <input type="date" name="connection_date" class="form-control" id="connection_date" placeholder="Connection Date" value="{{$customerById->connection_date}}" required>
                            </div>

                            <div class="form-group">
                                <label for="speed">Speed</label>
                                <input type="string" name="speed" class="form-control" id="speed" placeholder="Speed" value="{{$customerById->speed}}">
                            </div>


                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Status</label>
                                    <select name="status" class="form-control" style="margin-bottom: 5px;">
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                </div>

                                <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- zone modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Zone Form</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" enctype="multipart/form-data" method="post" action="{{ url('zoneStore')}}">
                            {{ csrf_field() }}

                            <div class="form-group error">
                                <label for="inputName" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control has-error" id="zone_name" name="zone_name" placeholder="Zone Name" value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-warning" type="submit" id="btn-save">
                                    <span class="glyphicon glyphicon-plus"></span>Insert Zone
                                </button>
                            </div>
                            {{--<input type="submit" class="btn btn-primary" id="btn-save" value="add">--}}

                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
