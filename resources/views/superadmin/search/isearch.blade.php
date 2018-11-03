@extends('superadmin.master')

@section('title')
    View Income
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <?php $date = \Carbon\Carbon::now();
                    ?>
                    <b>The Accounting Statement of <?php echo $date->format('F'); ?>
                    </b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="float:right; padding-right:10px">
                        <a id="print_client_bill" class="btn btn-info btn-sm"
                           href="{{ route('income.create') }}">Add New<span class="glyphicon glyphicon-print"></span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-12"
         style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">


        <div class="form-group ">
            <form action="{{route('cdl')}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-1 text-center">
                        <label class="text-white">Date</label>
                    </div>
                    <div class="col-md-4">
                        <input type="date" class="form-control" name="startDate">
                    </div>

                    <div class="col-md-1 text-center">
                        <span>To</span>
                    </div>
                    <div class="col-md-4">
                        <input type="date" class="form-control" name="endDate">
                    </div>

                    <div class="col-md-2">
                        <input type="submit" class="btn btn-success btn-block" name="btnSearch" value="Search">
                    </div>
                </div>
            </form>
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
            <th>Amount</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>



        @foreach ($data as $income)
            <tr>
                <td>{{ ++$i }}</td>
                <td> {{ Carbon\Carbon::parse($income->created_at)->format('d-m-Y') }}</td>
                <td>{{ $income->amount	 }}</td>
                <td>{{ $income->account_details }}</td>
                <td>
                    <form action="{{ route('income.destroy',$income->incomeId) }}" method="POST">


                    <!--<a class="btn btn-info" href="{{ route('income.show',$income->incomeId) }}">Show</a>-->
                        <a class="btn-info" href="{{ route('income.edit',$income->incomeId) }}">Edit</a>


                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="pull-right">{{ $data->links() }}</div>

@endsection