@extends('superadmin.master')

@section('title')
    Account Statement
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
                           href="">Daily Accounting Statement <span class="glyphicon glyphicon-print"></span></a>
                        <a class="btn btn-success btn-sm" href="{{route('add-customer') }}">Print Statement <span class="glyphicon glyphicon-plus"></span></a>
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




    <section class="card">
        <div class="container">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-0" id="datatable-default">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $total = 0; ?>
                    <?php $new = 0;
                    ?>
                      @foreach($res as $key)
                        <tr>
                            <td></td>
                            <td style="color: RoyalBlue;"><a style="color: RoyalBlue;" href="{{ url('/daily/date/'.Carbon\Carbon::parse($key->dates)->format('Y-m-d ')) }}"> {{ $key->dates }}</a></td>
                            <td>{{$users->username}}</td>
                            <td>{{ $key->sums  }}</td>

                            <td>{{ $key->expenses  }}</td>
                           <td>


                               <?php


                    if  ($key->expenses == null )

                    {
                        $new = $key->sums + $new;

                    }

                    else
                    {
                        $new = $new - $key->expenses;

                        }

                    ?>

                      {{$new}}

                           </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4>Options total: {{ $total }}</h4>
            </div>
        </div>


        <div class="row">

            <div class="col-md-12 bg-slate-800">
                <h4 class="text-center">
                    <strong><small>Total Balance : </small>-4400 Taka</strong>
                </h4>
            </div>
            <div class="col-md-12 bg-grey-800">
                <h4 class="text-center">
                    <strong><small>Balance Ammount In Word :  </small>Negative Four Thousand Four Hundred</strong>
                </h4>
            </div>

        </div>


    </section>
    <!-- end: page -->

@endsection
