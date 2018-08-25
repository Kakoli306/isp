@extends('superadmin.master')

@section('title')
    View Income
    @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Total Other Income</h2>
            </div>

            <div class="pull-left">
                <h2>{{$total}}</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('income.create') }}"> Create New </a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Head</th>
            <th>Amount</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($incomes as $income)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $income->created_at }}</td>
                <td>{{ $income->product_id }}</td>
                <td>{{ $income->amount	 }}</td>
                <td>{{ $income->account_details }}</td>
                <td>
                    <form action="{{ route('income.destroy',$income->id) }}" method="POST">


                        <a class="btn btn-info" href="{{ route('income.show',$income->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('income.edit',$income->id) }}">Edit</a>


                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach


    </table>




@endsection