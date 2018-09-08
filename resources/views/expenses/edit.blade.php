@extends('superadmin.master')

@section('title')
    Edit Expense
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Expense</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('expenses.index') }}"> Back</a>
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


    <form action="{{ route('expenses.update',$expenses->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="view overlay">
                <div class="card-body">
                    <select id="product_id" type="product_id" class="form-control"
                            name="product_id" value="{{ $expenses->name }}" >
                        @foreach ($product as $value)
                            <option value="{{$value->id}}" > {{$value->name}}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <strong>Amount:</strong>
                        <input type="float" name="price" class="form-control" value="{{ $expenses->price }}" placeholder="Name">
                    </div>
                </div>

                <div class="form-group">
                    <strong>Detail:</strong>
                    <input class="form-control"  name="name" value="{{ $expenses->name }}"placeholder="Detail"></input>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>


@endsection