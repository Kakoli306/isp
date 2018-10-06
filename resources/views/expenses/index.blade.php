@extends('superadmin.master')

@section('title')
    View Expense
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12"
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">

            <div class="col-md-6">
                <b>View Expense Information</b>
            </div>
            <div class="col-md-12" style="">
                <a class="btn btn-info btn-xs pull-right" href="{{route('expenses.create') }}">ADD NEW<span></span></a>
            </div>
        </div>

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>

            <div class="pull-left">
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


        @foreach ($expenses as $expense)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ Carbon\Carbon::parse($expense->created_at)->format('d-m-Y') }}</td>
                <td>{{ $expense->name }}</td>
                <td>{{ $expense->price }}</td>
                <td>{{ $expense->description }}</td>

                <td>
                    <form action="{{ route('expenses.destroy',$expense->id) }}" method="POST">


                        <a class="btn btn-primary" href="{{ route('expenses.edit',$expense->id) }}">Edit</a>


                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $expenses->links() }}

@endsection