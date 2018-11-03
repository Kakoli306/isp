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
                        <a class="btn btn-success btn-sm" href=" ">Print Statement <span class="glyphicon glyphicon-plus"></span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12"
         style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">


        <form action="{{route('filter-by-date')}}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-3 text-center">
                    <label class="text-white">Date</label>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="startDate">
                </div>

                <div class="col-md-1 text-center">
                    <span>To</span>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="endDate">
                </div>

                <div class="col-md-1">
                    <input type="submit" class="btn btn-success btn-block" name="btnSearch" value="Search">
                </div>
            </div>
        </form>


    </div>


    <section class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                </div>
            </div>
            <table class="table table-bordered">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>User</th>
                    <th>Credit</th>

                </tr>
                </thead>
                <tbody>

                <?php $new = 0;
                ?>
                @foreach($data as $key)
                    <tr>
                        <td></td>
                        <td> {{ $key->month }}</td>
                        <td>{{$users->username}}</td>
                        <td>{{ $key->payment_description  }}</td>
                        <td>



                        </td>
                    </tr>
                @endforeach
                </tbody>


                <tr style="font-size:14px;">
                    <td colspan="3" class="text-center"><b>Total</b></td>
                    <td class="text-center"><b></b></td>
                    <td class="text-center"><b></b></td>
                    <td class="text-center"><b></b></td>
                </tr>



            </table>

        </div>


        <?php //function numtowords($num){
        //$decones = array(
        //            '01' => "One",
        //            '02' => "Two",
        //            '03' => "Three",
        //            '04' => "Four",
        //            '05' => "Five",
        //            '06' => "Six",
        //            '07' => "Seven",
        //            '08' => "Eight",
        //            '09' => "Nine",
        //            10 => "Ten",
        //            11 => "Eleven",
        //            12 => "Twelve",
        //            13 => "Thirteen",
        //            14 => "Fourteen",
        //            15 => "Fifteen",
        //            16 => "Sixteen",
        //            17 => "Seventeen",
        //            18 => "Eighteen",
        //            19 => "Nineteen"
        //            );
        //$ones = array(
        //            0 => " ",
        //            1 => "One",
        //            2 => "Two",
        //            3 => "Three",
        //            4 => "Four",
        //            5 => "Five",
        //            6 => "Six",
        //            7 => "Seven",
        //            8 => "Eight",
        //            9 => "Nine",
        //            10 => "Ten",
        //            11 => "Eleven",
        //            12 => "Twelve",
        //            13 => "Thirteen",
        //            14 => "Fourteen",
        //            15 => "Fifteen",
        //            16 => "Sixteen",
        //            17 => "Seventeen",
        //            18 => "Eighteen",
        //            19 => "Nineteen"
        //            );
        //$tens = array(
        //            0 => "",
        //            2 => "Twenty",
        //            3 => "Thirty",
        //            4 => "Forty",
        //            5 => "Fifty",
        //            6 => "Sixty",
        //            7 => "Seventy",
        //            8 => "Eighty",
        //            9 => "Ninety"
        //            );
        //$hundreds = array(
        //            "Hundred",
        //            "Thousand",
        //            "Million",
        //            "Billion",
        //            "Trillion",
        //            "Quadrillion"
        //            ); //limit t quadrillion
        //$num = number_format($num,2,".",",");
        //$num_arr = explode(".",$num);
        //$wholenum = $num_arr[0];
        //$decnum = $num_arr[1];
        //$whole_arr = array_reverse(explode(",",$wholenum));
        //krsort($whole_arr);
        //$rettxt = "";
        //foreach($whole_arr as $key => $i){
        //    if($i < 20){
        //        $rettxt .= $ones[$i];
        //    }
        //    elseif($i < 100){
        //        $rettxt .= $tens[substr($i,0,1)];
        //        $rettxt .= " ".$ones[substr($i,1,1)];
        //    }
        //    else{
        //        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
        //        $rettxt .= " ".$tens[substr($i,1,1)];
        //        $rettxt .= " ".$ones[substr($i,2,1)];
        //    }
        //    if($key > 0){
        //        $rettxt .= " ".$hundreds[$key]." ";
        //    }
        //
        //}
        //$rettxt = $rettxt." peso/s";
        //
        //if($decnum > 0){
        //    $rettxt .= " and ";
        //    if($decnum < 20){
        //        $rettxt .= $decones[$decnum];
        //    }
        //    elseif($decnum < 100){
        //        $rettxt .= $tens[substr($decnum,0,1)];
        //        $rettxt .= " ".$ones[substr($decnum,1,1)];
        //    }
        //    $rettxt = $rettxt." centavo/s";
        //}
        //return $rettxt;} ?>



        <div class="row">

            <div class="col-md-12 bg-slate-800">
                <h4 class="text-center">
                    <strong><small>Total Balance :  </small>
                    </strong>
                </h4>
            </div>
            <div class="col-md-12 bg-grey-800">
                <h4 class="text-center">

                </h4>
            </div>

        </div>


    </section>
    <!-- end: page -->

@endsection
