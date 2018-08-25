@extends('superadmin.master')
@section('title')
    View Payment Information
@endsection
@section('content')

    <div class="card">
        <div class="view overlay">
            <div class="card-body">

                <form role="form" enctype="multipart/form-data" method="post" action="{{ route('update-billing')}}">
                    {{ csrf_field() }}

                    <input type="hidden"  name="customer_id" value="{{$BillingById->id}}">

                    <table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile Number</th>
                            <th>Speed</th>
                            <th>Bill</th>
                            <th>Connection Date</th>
                            <th>Zone</th>
                            <th>IP</th>
                            <th>Actions</th>
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
                            <td>{{$BillingById->connection_date}}</td>
                            <td>{{$BillingById->zone_id}}</td>
                            <td>{{$BillingById->ip_address}}</td>

                            <td class="center">
                                <input type="hidden" value="{{ $BillingById->customer_id }}" name="customer_id">
                                <a href="" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </form>


                <div class="card">
                    <div class="view overlay">
                        <div class="card-body">
                            <h2 class="text-center text-success">{{Session::get('message')}}</h2>

                            <form role="form" enctype="multipart/form-data" method="post" action="{{ route('bill_cat')}}">
                                {{ csrf_field() }}
                                <div class="row" style="padding:10px; font-size: 12px;">

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Connection Charge</label>
                                            <input class="form-control" id="inputDisabled" type="Disable" value="{{$BillingById->connection_charge}}" placeholder="input here..." disabled="">
                                        </div>

                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Payment Date</label>
                                            <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Pay Amount</label>
                                            <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_amount">Payment Amount</label>
                                            <input type="number" name="payment_amount" class="form-control" id="payment_amount" placeholder="Payment Amount" required>
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Due Amount</label>
                                            <input class="form-control" id="inputDisabled" type="Disabled" placeholder=" input here..." disabled="">
                                        </div>

                                        <div class="form-group">
                                            <label for="discount">Discount(Optional)</label>
                                            <input type="number" name="discount" class="form-control" id="discount" placeholder="Discount">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="payment_description">Payment Description</label>
                                        <input type="text" name="payment_description" class="form-control" id="payment_description" placeholder="Payment Description">
                                    </div>
                                    </div>

                                    <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
                                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>


@endsection
