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

                    <input type="hidden"  name="id" value="{{$BillingById->id}}">

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
                                <input type="hidden" value="{{ $BillingById->id }}" name="customer_id">
                                <a href="{{ route('edit',['id'=>$BillingById->id]) }}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </form>


               <!-- <div class="card">
                    <div class="view overlay">
                        <div class="card-body">

                            <form role="form" enctype="multipart/form-data" method="post" action="{{url('/payment/add/'.$BillingById->id)}}">
                                {{ csrf_field() }}



                                <div class="row" style="padding:10px; font-size: 12px;">

                                    <div class="col-md-4 col-md-offset-1">

                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="created_at">Payment Date</label>
                                            <input class="form-control" id="created_at" type="date" name="created_at" placeholder="Disabled input here..." >
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="pay_amount">Pay Amount</label>
                                            <input class="form-control" id="pay_amount" type="number" name="pay_amount" placeholder="Disabled input here..." >
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="due_amount">Due Amount</label>
                                            <input class="form-control" id="due_amount" type="Disabled" name ="due_amount" placeholder=" input here..." >
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                    </div>

                                    <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
                                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form> -->

                            <form role="form" enctype="multipart/form-data" method="post" action="{{url('/billing/add/'.$BillingById->id)}}">
                                {{ csrf_field() }}

                                <input type="hidden"  name="id" value="{{$BillingById->id}}">



                                <div class="row" style="padding:10px; font-size: 12px;">

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Connection Charge</label>
                                            <input class="form-control" id="inputDisabled" type="Disable" value="{{$BillingById->connection_charge}}" placeholder="input here..." disabled="">
                                        </div>

                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Payment Date</label>
                                            <input class="form-control" id="inputDisabled" type="Disable" value="{{$date->updated_at}}" name="" placeholder="Disabled input here..." disabled="">
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Pay Amount</label>
                                            <?php $lifetime_paid=DB::table('billings')->where('customer_id',$BillingById->id)->sum('payment_amount'); ?>

                                            <input class="form-control" id="inputDisabled" type="text" name="pay_amount" value="{{$lifetime_paid}}" placeholder="Disabled input here..." disabled="" >
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_amount">Payment Amount</label>
                                            <input type="number" name="payment_amount" class="form-control" id="payment_amount" placeholder="Payment Amount" required>
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="exampleInputEmail1" for="inputDisabled">Due Amount</label>
                                            <?php $lifetime_due=DB::table('payments')->where('customer_id',$BillingById->id)->sum('due_amount'); ?>

                                            <input class="form-control" id="inputDisabled" type="Disabled" name = "due_amount" value="{{$new}}" placeholder=" input here..." disabled="">
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

                    </div>

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
                                <td>{{ $value->created_at }}</td>
                                <td>{{ $value->payment_description }}</td>
                                <td>{{ $value->payment_amount }}</td>
                                 <td>{{ $users->username }}</td>



                        <td class="center">

                            <a class="btn btn-info" href="">Print</a>

                            <input type="hidden" value="{{ $value->id }}" name="billing_id">

                            <a href="{{ route('edit-amount',['id'=>$value->id]) }}" class="on-default edit-row">
                                <i class="fas fa-pencil-alt"></i></a>


                            <form action="{{ route('delete-billing') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$value->id}}" name="billing_id">
                                <button type="submit" onclick="return confirm('Are u sure to delete this !!!')"
                                        class="on-default remove-row"><i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                        @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>




@endsection
