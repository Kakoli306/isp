@extends('superadmin.master')

@section('title')
    Specific Expense report
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <a id="print_client_bill" class="btn btn-info btn-sm"
                       href="{{route('expense_report')}}">Back To Expense report <span class="glyphicon glyphicon-print"></span></a>

                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="float:right; padding-right:10px">
                        <a class="btn btn-success btn-sm" href="">Print Statement <span class="glyphicon glyphicon-plus"></span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <section class="card">
        <table class="table table-bordered">

                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach ($exp as $expense)
                                <tr>
                                    <td>{{Carbon\Carbon::parse($expense->created_at)->format('Y-m-d ') }} </td>
                                    <td>{{$expense->description}}</td>
                                    <td>{{$expense->price}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
            <div class="row">

                <div class="col-md-12 bg-slate-800">
                    <h4 class="text-center">
                    </h4>
                </div>
                <div class="col-md-12 bg-grey-800">
                    <h4 class="text-center">


                        <strong><small>Total Expense :{{$exp->sum('price')}}  </small>
                        </strong>
                    </h4>
                </div>

            </div>
    </section>

@endsection