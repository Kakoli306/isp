@extends('superadmin.master')

@section('title')
    Edit Income
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Income</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('income.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('income.update',$income->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="view overlay">
                <div class="card-body">
                    <select id="product_id" type="product_id" class="form-control"
                            name="product_id" value="{{ $income->name }}" >
                        @foreach ($product as $value)
                            <option value="{{$value->id}}" > {{$value->name}}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <strong>Amount:</strong>
                        <input type="float" name="amount" class="form-control" value="{{ $income->amount }}" placeholder="Name">
                    </div>
                </div>

                <div class="form-group">
                    <strong>Detail:</strong>
                    <input class="form-control"  name="account_details" value="{{ $income->account_details }}"placeholder="Detail"></input>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>


@endsection