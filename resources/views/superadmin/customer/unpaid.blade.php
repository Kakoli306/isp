@extends('superadmin.master')

@section('title')
    Unpaid Customer
@endsection

@section('content')

    <section class="card">
        <div class="container">

            <header class="card-header">
                <h2 class="card-title">View Customer Information</h2>
            </header>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">

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

                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->mobile_no }}</td>
                            <td>{{ $customer->speed}}</td>
                            <td>{{ $customer->bill_amount	}}</td>
                            <td>{{ $customer->email}}</td>
                            <td>
                                <?php $lifetime_paid=DB::table('billings')->where('customer_id',$customer->id)->sum('payment_amount'); ?>
                                <?php
                                $flag=$customer->bill_amount;
                                $flag1 = $customer->month_amount;

                                $sum=$flag - $flag1;
                                ?>

                                <?php
                                $date = Carbon\Carbon::parse(($customer->connection_date));
                                $now = Carbon\Carbon::now();

                                $diff = $date->diffInMonths($now);
                                $a =$diff * $customer->bill_amount;

                                $flag=$customer->bill_amount;
                                $flag1 = $customer->month_amount;

                                $sum=$flag - $flag1;

                                $pay = $lifetime_paid;
                                $ok = $pay - $sum;

                                $due = $a - $ok;

                                //dd($due);
                                echo $due
                                ?>
                            </td>

                            <td>{{ $customer->ip_address}}</td>
                        </tr>
                    </tbody>
                    @endforeach

                </table>
                {{ $customers->links() }}

            </div>
        </div>
    </section>
    <!-- end: page -->

@endsection
