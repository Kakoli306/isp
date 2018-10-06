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


            <div class="form-group row">
                <label class="col-lg-3 control-label text-lg-right pt-2 ">From Date</label>
                <div class="col-lg-6">
                    <div class="input-daterange input-group" data-plugin-datepicker>
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></span>

                        <input type="text" class="form-control" name="start">
                        <span class="input-group-text border-left-0 border-right-0 rounded-0">
															To Date
														</span>
                        <input type="text" class="form-control" name="end">
                    </div>
                </div>

                <div class="col-lg-3">
                    <button type="submit"  name="search" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
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



        @foreach ($shows as $income)
            <tr>
                <td>{{ ++$i }}</td>
                <td> {{ Carbon\Carbon::parse($income->created_at)->format('d-m-Y') }}</td>
                <td>{{ $income->name }}</td>
                <td>{{ $income->amount	 }}</td>
                <td>{{ $income->account_details }}</td>
                <td>
                    <form action="{{ route('income.destroy',$income->incomeId) }}" method="POST">


                    <!--<a class="btn btn-info" href="{{ route('income.show',$income->incomeId) }}">Show</a>-->
                        <a class="btn btn-primary" href="{{ route('income.edit',$income->incomeId) }}">Edit</a>


                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $shows->links() }}


@endsection