@extends('superadmin.master')
@section('title')
    Show Information
@endsection
@section('content')

    <div class="card">
        <div class="view overlay">
            <div class="card-body">

                <h2 class="text-center text-success">{{Session::get('message')}}</h2>


                <form role="form" enctype="multipart/form-data" method="post" action="{{ route('update-billing')}}">
                    {{ csrf_field() }}


                  <input  name ="id" value="{{ $custId->id }}">

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

                        <tr>
                            <td>{{$custId->id}}</td>
                            <td>{{$custId->customer_name}}</td>
                            <td>{{$custId->address}}</td>
                            <td>{{$custId->mobile_no}}</td>
                            <td>{{$custId->speed}}</td>
                            <td>{{$custId->bill_amount}}</td>
                            <td>{{$custId->connection_date}}</td>
                            <td>{{$custId->zone_id}}</td>
                            <td>{{$custId->ip_address}}</td>

                            <td class="center">
                                <input type="hidden" value="{{ $custId->id }}" name="customer_id">
                                <a href="{{ route('edit',['id'=>$custId->id]) }}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>

                        <div class="row" style="padding:10px; font-size: 12px;">

                                <div class="col-md-4 col-md-offset-1">

                                </div>

                                <div class="col-md-4 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="exampleInputEmail1" for="inputDisabled">Pay Amount</label>
                                        <?php $lifetime_paid=DB::table('billings')->where('customer_id',$custId->id)->sum('payment_amount'); ?>

                                        <input class="form-control" id="inputDisabled" type="text" name="pay_amount" value="{{$lifetime_paid}}" placeholder="Disabled input here..." disabled="" >
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_amount">Bill Amount</label>
                                        <input type="number" name="payment_amount" class="form-control" id="bill_amount" placeholder="Bill Amount" value="{{$custId->bill_amount}}" disabled="">
                                    </div>

                                </div>

                                <div class="col-md-4 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="exampleInputEmail1" for="inputDisabled">Due Amount</label>

                                        <?php $lifetime_paid=DB::table('billings')->where('customer_id',$custId->id)->sum('payment_amount'); ?>
                                        <?php
                                        $flag=$custId->bill_amount;
                                        $flag1 = $custId->month_amount;

                                        $sum=$flag - $flag1;
                                        ?>

                                        <?php
                                        $date = Carbon\Carbon::parse(($custId->connection_date));
                                        $now = Carbon\Carbon::now()->subMonth();

                                        $diff = $date->diffInMonths($now);

                                        $a =$diff * $custId->bill_amount;

                                        $flag=$custId->bill_amount;
                                        $flag1 = $custId->month_amount;

                                        $sum=$flag - $flag1;

                                        $pay = $lifetime_paid;
                                        $ok = $pay - $sum;

                                        $predue = $a - $ok;
                                        echo $predue;

                                        ?>
                                        <input class="form-control" id="inputDisabled" type="Disabled" name = "due_amount" value="{{$predue}}" placeholder=" input here..." disabled="">
                                    </div>

                                      </div>

                            </div>

                        <div class="card-body">
                            <div class="row">

                            </div>

                            <table class="table table-bordered">

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


                    </table>
                </form>





@endsection
