@extends('superadmin.master')

@section('title')
    Unpaid Customer
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <b>View All Paid Customer List</b>
                </div>

            </div>
        </div>
    </div>

    <section class="card">
        <div class="card-body">


        <div class="row" style="margin-bottom:10px;">
        <div class="col-md-4">
            <div class="summary">
                <div class="info">
                    <strong class="amount"></strong>
                </div>
            </div>

        </div>

        <div class="col-md-4 col-md-offset-4">

        </div>

        <div class="col-md-4 col-md-offset-4">
            <form>
                <div class="input-group">
                    <input type="search_text" name="search_text" id="search_text" class="form-control" placeholder="Search for...">
                </div>
            </form>
        </div>

    </div>


    <div class="card-body">
            <div class="row">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                </div>
                <table class="table table-bordered">
                    <h3 align="center">Total Data : <span id="total_records"></span></h3>

                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Customer ID</th>
                        <th>Address</th>
                        <th>Mobile Number</th>
                        <th>Speed</th>
                        <th>Bill</th>
                        <th>Email</th>
                        <th>Amount of Dues</th>
                        <th>IP</th>
                    </tr>
                    </thead>
                    <tbody>


                    {{--@foreach($customers as $customer)--}}
                        {{--<tr>--}}
                            {{--<td>{{ ++$i }}</td>--}}
                            {{--<td>{{ $customer->customer_name }}</td>--}}
                            {{--<td>{{ $customer->id }}</td>--}}
                            {{--<td>{{ $customer->address }}</td>--}}
                            {{--<td>{{ $customer->mobile_no }}</td>--}}
                            {{--<td>{{ $customer->speed}}</td>--}}
                            {{--<td>{{ $customer->bill_amount	}}</td>--}}
                            {{--<td>{{ $customer->email}}</td>--}}
                            {{--<td>--}}
<!--                                --><?php //$lifetime_paid=DB::table('billings')->where('customer_id',$customer->id)->sum('payment_amount'); ?>
<!--                                --><?php
//                                $flag=$customer->bill_amount;
//                                $flag1 = $customer->month_amount;
//
//                                $sum=$flag - $flag1;
////                                ?>

<!--                                --><?php
//                                $date = Carbon\Carbon::parse(($customer->connection_date));
//                                $now = Carbon\Carbon::now();
//
//                                $diff = $date->diffInMonths($now);
//                                $a =$diff * $customer->bill_amount;
//
//                                $flag=$customer->bill_amount;
//                                $flag1 = $customer->month_amount;
//
//                                $sum=$flag - $flag1;
//
//                                $pay = $lifetime_paid;
//                                $ok = $pay - $sum;
//
//                                $due = $a - $ok;

                                //dd($due);
//                                echo $due
//                                ?>

                            {{--</td>--}}

                            {{--<td>{{ $customer->ip_address}}</td>--}}
                        {{--</tr>--}}
                    {{--</tbody>--}}
                    {{--@endforeach--}}

                </table>
                <div class="pull-right">{{ $customers->links() }}</div>
            </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

                <script>
                    $(document).ready(function(){

                        fetch_unpaid_data();

                        function fetch_unpaid_data(query = '')
                        {
                            $.ajax({
                                url:"{{ route('bse') }}",
                                method:'GET',
                                data:{query:query},
                                dataType:'json',
                                success:function(data)
                                {
                                    $('tbody').html(data.table_data);
                                    $('#total_records').text(data.total_data);
                                }
                            })
                        }

                        $(document).on('keyup', '#search_text', function(){
                            var query = $(this).val();
                            fetch_unpaid_data(query);
                        });
                    });
                </script>
            </div>
        </div>
        </div>
    </section>

    <!-- end: page -->

@endsection
