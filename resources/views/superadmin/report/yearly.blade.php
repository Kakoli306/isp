@extends('superadmin.master')

@section('title')
    Yearly Report
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <?php $date = \Carbon\Carbon::now();
                    ?>
                    <b>Yearly Income Sheet of <?php echo $date->format(' Y'); ?></b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{--<div class="col-md-12"--}}
         {{--style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">--}}


        {{--<div class="form-group row">--}}
            {{--<label class="col-lg-3 control-label text-lg-right pt-2 ">From Date</label>--}}
            {{--<div class="col-lg-6">--}}
                {{--<div class="input-daterange input-group" data-plugin-datepicker>--}}
                    {{--<span class="input-group-prepend">--}}
                        {{--<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></span>--}}

                    {{--<input type="text" class="form-control" name="start">--}}
                    {{--<span class="input-group-text border-left-0 border-right-0 rounded-0">--}}
														{{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-lg-3">--}}
                {{--<button type="submit"  name="search" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>--}}
            {{--</div>--}}

        {{--</div>--}}


    {{--</div>--}}


    <section class="card">
            <div class="card-body">
                <div class="text-left;">
                    <script>
                        function goBack() {
                            window.history.back()
                        }
                    </script>

                    <button onclick="goBack()"><i class="fas fa-arrow-left"></i> </button>

                </div>

                <table class="table table-bordered">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Month</th>
                        <th>Opening Balance</th>
                        <th>Customer Payment</th>
                        <th>Others Payment</th>
                        <th>Connection Charge</th>
                        <th>Total</th>
                        <th>Expense Statement</th>
                        <th>Closing Balance</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php $ob = 0;
                    ?>

                    @foreach($year as $key => $merged)
                        <tr>
                            <td></td>
                            <td style="color: RoyalBlue;"><a style="color: RoyalBlue;" href="{{ url('/new/month/'.Carbon\Carbon::parse($key)->format('Y-m')) }}">{{ $key  }}</a></td>
                            <td>
                                <?php


                                if  ($ob == null )

                                {
                                    $obb = $ob;

                                }

                                else
                                {
                                    $obb = $new - $cb;

                                }

                                ?>

                            </td>
                            <td>
                                @foreach($merged as $customer)
                                    {{ $customer->sums }}
                                @endforeach
                            </td>

                            <td>
                                @foreach($merged as $customer)
                                    {{ $customer->incomes }}
                                @endforeach
                            </td>

                            <td>
                                @foreach($merged as $customer)
                                    {{ $customer->charge }}
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

                            <td>
                                @foreach($merged as $customer)
                                    {{ $customer->expenses }}
                                @endforeach
                            </td>
                            <td>
                                <?php
                                    $cb = $total - $customer->expenses
                                ?>
                                   {{$cb}}
                            </td>

                        </tr>
                    @endforeach

                </table>
            </div>

    </section>
    <!-- end: page -->

@endsection