@extends('superadmin.master')

@section('title')
    Edit Amount
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <b>View Amount Edit Information
                    </b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">
                    </div>
                </div>
                <div class="col-md-4">

                </div>

            </div>
        </div>
    </div>


    <div class="card">
        <div class="view overlay">
            <div class="card-body">

                <h2 class="text-center text-success">{{Session::get('message')}}</h2>

                <form  method="post" action="{{ route('update-billing')}}">
                    {{ csrf_field() }}

                    <input type="hidden"  name="billing_id" value="{{$bills->id}}">

                    <div class="row" style="padding: 5px 0px 15px 0px;  text-align: center;">


                            <div class="col-md-12"style="font-size: 12px; " >
                            <strong for="payment_amount">Payment Amount</strong>
                            <input type="number" name="payment_amount" class="form-control" id="payment_amount" placeholder="Payment Amount"
                                   value="{{$bills->payment_amount}}">
                                <div class="row" style="padding: 5px 0px 15px 0px;font-size: 12px; text-align: center;">
                                    <button type="submit" name="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>



                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
