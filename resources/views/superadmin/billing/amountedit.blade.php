@extends('superadmin.master')

@section('title')
    Edit Amount
@endsection
@section('content')

    <div class="card">
        <div class="view overlay">
            <div class="card-body">

                <h2 class="text-center text-success">{{Session::get('message')}}</h2>

                <form  method="post" action="{{ route('update-billing')}}">
                    {{ csrf_field() }}

                    <input type="hidden"  name="billing_id" value="{{$bills->id}}">

                    <div class="row" style="padding:10px; font-size: 12px;">

                        <div class="form-group">
                            <label for="payment_amount">Payment Amount</label>
                            <input type="number" name="payment_amount" class="form-control" id="payment_amount" placeholder="Payment Amount"
                                   value="{{$bills->payment_amount}}">
                        </div>


                        <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
                            <button type="submit" name="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
