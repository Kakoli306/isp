@extends('superadmin.master')

@section('title')
    Monthly Report
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <?php $date = \Carbon\Carbon::now();
                    ?>
                    <b>The Monthly Statement of <?php echo $date->format('F'); ?>
                    </b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="float:right; padding-right:10px">
                        <a class="btn btn-success btn-sm" href=" ">Print Statement <span class="glyphicon glyphicon-plus"></span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12"
         style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">


        <div class="form-group row">
            <label class="col-lg-3 control-label text-lg-right pt-2 ">Select Month</label>
            <div class="col-lg-6">
                <div class="input-daterange input-group" data-plugin-datepicker>
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></span>

                    <input type="text" class="form-control" name="start">
                    <span class="input-group-text border-left-0 border-right-0 rounded-0">
															Select Year
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
                        <th>Bill Collection</th>
                        <th>Connection Charge</th>
                        <th>Others Income</th>
                        <th>Expense</th>
                    </tr>
                    </thead>
                   <tbody>
                    @foreach($res as $key => $merged)
                        <tr>
                        <td></td>
                       <td>{{ $key  }}</td>
                     <td style="color: RoyalBlue;">
                       @foreach($merged as $customer)
                                 <a style="color: RoyalBlue;" href="{{ url('/daily/date/'.Carbon\Carbon::parse($customer->dates)->format('Y-m-d ')) }}">{{ $customer->sums }}</a>
                                @endforeach
                     </td>
                            <td style="color: RoyalBlue;">
                                    <a style="color: RoyalBlue;" href="{{ url('/con/date/'.Carbon\Carbon::parse($customer->dates)->format('Y-m-d ')) }}">{{ $customer->charge }}</a>
                            </td>

                            <td>
                                    <a style="color: RoyalBlue;"  href="{{ url('/inc/date/'.Carbon\Carbon::parse($customer->dates)->format('Y-m-d ')) }}">{{ $customer->incomes }}</a>
                            </td>

                            <td>
                                    <a style="color: RoyalBlue;" href="{{ url('/exp/date/'.Carbon\Carbon::parse($customer->dates)->format('Y-m-d ')) }}">{{ $customer->expenses }}</a>
                            </td>
                        </tr>
                    @endforeach
                   </tbody>
                    <tr style="font-size:14px;">
                        <td colspan="2" class="text-center"><b>Total Income</b></td>
                        <td class="text-center"><b>{{$res->sum('sums')}}</b></td>
                        <td class="text-center"><b></b></td>
                        <td class="text-center"><b></b></td>
                    </tr>

                </table>
            </div>
    </section>
    <!-- end: page -->

    <div class="col-md-4 col-md-offset-4">
        <div>
            <table class="table">
                <tr>
                    <td><b>Opening Balance:</b></td>
                    <th style="text-align: right;">24,700.00 Taka</th>
                </tr>
                <tr>
                    <td><b>Total Income:</b></td>
                    <th style="text-align: right;">16,000.00 Taka</th>
                </tr>
                <tr>
                    <td><b>Total Expense:</b></td>
                    <th style="text-align: right;">24,500.00 Taka</th>
                </tr>
                <tr>
                    <td><b>Cash In Hand:</b></td>
                    <th style="text-align: right;">16,200.00 Taka</th>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="col-md-12 bg-danger">
        <h4 class="text-center" style="padding-bottom:30px">Cash In Hand
            Word: Sixteen Thousand Two Hundred</h4>
        <h6 class="pull-right text-center" style="border-top:2px solid black;width:40%">Authorized Signature<h3>
    </div>
    </div>


@endsection