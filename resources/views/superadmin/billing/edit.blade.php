@extends('superadmin.master')
@section('title')
    View Payment Information
@endsection
@section('content')

    <div class="card">
        <div class="view overlay">
            <div class="card-body">

                <h2 class="text-center text-success">{{Session::get('message')}}</h2>


                <form role="form" enctype="multipart/form-data" method="post" action="{{ route('update-billing')}}">
                    {{ csrf_field() }}

                    <input type="hidden"  name="id" value="{{$BillingById->customer_id}}">


                    <table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile Number</th>
                            <th>Speed</th>
                            <th>Bill</th>
                            <th>Month Amount</th>
                            <th>Connection Date</th>
                            <th>Zone</th>
                            <th>IP</th>
                            <th class="col-lg-1">Actions</th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td>{{$BillingById->id}}</td>
                            <td>{{$BillingById->customer_name}}</td>
                            <td>{{$BillingById->address}}</td>
                            <td>{{$BillingById->mobile_no}}</td>
                            <td>{{$BillingById->speed}}</td>
                            <td>{{$BillingById->bill_amount}}</td>
                            <td>{{$BillingById->month_amount}}</td>
                            <td>{{$BillingById->connection_date}}</td>
                            <td>{{$BillingById->zone_id}}</td>
                            <td>{{$BillingById->ip_address}}</td>


                            <td class="center">
                                <input type="hidden" value="{{ $BillingById->id }}" name="customer_id">
                                <a href="{{ route('edit',['id'=>$BillingById->id]) }}" class="btn btn-info">Edit</a>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </form>

                            <form role="form" enctype="multipart/form-data" method="post" action="{{url('/billing/add/'.$BillingById->id)}}">
                                {{ csrf_field() }}

                                <input type="hidden"  name="id" value="{{$BillingById->id}}">


                            <?php $new = DB::table('billings')->where('customer_id',$BillingById->id)->first(); ?>


                                <div class="row" style="padding:10px; font-size: 12px;">

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Connection Charge</label>
                                            <input class="form-control" id="inputDisabled" type="Disable" value="{{$BillingById->connection_charge}}" disabled="">
                                        </div>

                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Payment Date</label>
                                            <input class="form-control" id="inputDisabled" type="Disable" value="" name="" disabled="">
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Pay Amount</label>
                                            <?php $lifetime_paid=DB::table('billings')->where('customer_id',$BillingById->id)->sum('payment_amount'); ?>

                                            <input class="form-control" id="inputDisabled" type="text" name="pay_amount" value="{{$lifetime_paid}}"  disabled="" >
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_amount">Payment Amount</label>
                                            <input type="number" name="payment_amount" class="form-control" id="payment_amount" placeholder="Payment Amount">
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Due Amount</label>

                                            <?php
                                            $flag=$BillingById->bill_amount;
                                                $flag1 = $BillingById->month_amount;

                                            $sum=$flag - $flag1;
                                            ?>

                                         <?php


                                            $date = Carbon\Carbon::parse(($BillingById->connection_date));
                                            $now = Carbon\Carbon::now();

                                            $diff = $date->diffInMonths($now);
                                            $a =$diff * $BillingById->bill_amount;

                                            $flag=$BillingById->bill_amount;
                                            $flag1 = $BillingById->month_amount;

                                            $sum=$flag - $flag1;

                                            $pay = $lifetime_paid;
                                            $ok = $pay - $sum;

                                            $due = $a - $ok;

                                            //dd($due);
                                            ?>


                                            <input class="form-control" id="inputDisabled" type="Disabled" name = "due_amount" value="{{$due}}" placeholder=" input here..." disabled="">
                                        </div>

                                        <div class="form-group">
                                            <label for="discount">Discount(Optional)</label>
                                            <input type="number" name="discount" class="form-control" id="discount" placeholder="Discount">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="payment_description">Payment Description</label>
                                        <input type="text" name="payment_description" class="form-control" id="payment_description"  placeholder="Payment Description">
                                    </div>
                                    </div>

                                    <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
                                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>


                    <div class="card-body">
                    <div class="row">

                        <table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Received by</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($bills as $value)
                    <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $value->payment_description }}</td>
                                <td>{{ $value->payment_amount }}</td>
                                 <td>{{ $users->username }}</td>



                        <td class="center">

                            <a class="mb-1 mt-1 mr-1 btn btn-default" href="">Print</a>

                            <input type="hidden" value="{{ $value->id }}" name="billing_id">

                            <a href="{{ route('edit-amount',['id'=>$value->id]) }}" class=" btn-info">
                            Edit</a>


                            <form action="{{ route('delete-billing') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$value->id}}" name="billing_id">
                                <button type="submit" onclick="return confirm('Are u sure want to delete this !!!')"
                                        class="mb-1 mt-1 mr-1 btn btn-outline-danger">Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                        @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
    </div>
@endsection
