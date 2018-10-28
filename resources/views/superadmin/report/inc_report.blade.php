@extends('superadmin.master')
@section('title')
    Income Report
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <?php $date = \Carbon\Carbon::now();
                    ?>
                    <b>Monthly Income Sheet of <?php echo $date->format('F Y'); ?></b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">
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
															to Date
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

        <div class="col-sm-6" >

        </div>

        <div class="row">

            <div class="col-md-12" >
                <h2 style="text-align:center;"> <?php $date = \Carbon\Carbon::now();
                    echo $date->format('F Y');
                    ?>
                </h2>
            </div>
            <div class="col-md-12" id="month_print">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Bill Collection</th>
                        <th>Connection Charge</th>
                        <th>Others Income</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($res as $key => $merged)
                        <tr>
                            <td></td>
                            <td>{{ $key  }}</td>
                            <td>
                                @foreach($merged as $customer)
                                    {{ $customer->sums }}

                                @endforeach
                            </td>
                            <td>
                                @foreach($merged as $customer)
                                    {{ $customer->charge }}
                                @endforeach
                            </td>

                            <td>
                                @foreach($merged as $customer)
                                    {{ $customer->incomes }}
                                @endforeach
                            </td>

                            <td>
                                <?php

                                $total = $merged->sum(function ($merged) {
                                    return $merged->sums + $merged->charge + $merged->incomes;
                                });

                                ?>

                                {{$total}}
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>

        </div>

    </section>


@endsection