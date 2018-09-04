@extends('superadmin.master')

@section('title')
    Edit Amount
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



                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
