@extends('superadmin.master')

@section('title')
    Account Statement
@endsection

@section('content')
    {{ date('Y-m-d H:i:s') }}


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
                        <th>#</th>
                        <th>Date</th>
                        <th>Particular</th>
                        <th>Client</th>
                        <th>Ip</th>
                        <th>User</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $sum=0; ?>

                    @foreach($billings as $billing)
                        <tr>

                            <?php

                            $custId = $billing->customer_id;
                            $dues = DB::table('customers')
                                ->join('billings','billings.customer_id', '=', 'customers.id')
                                ->select('billings.*','customers.*')
                                ->where('billings.customer_id','=',$custId)
                                ->count('bill_amount');

                            $new = 0;

                            if($dues > 0) {

                                $bill_amount=0;

                                $due = DB::table('customers')
                                    ->join('billings','billings.customer_id', '=', 'customers.id')
                                    ->select('billings.*','customers.*')
                                    ->where('billings.customer_id','=',$custId)
                                    ->first();


                                $connection_charge = $due->connection_charge;
                                $month_amount = $due->month_amount;
                                $new = ($bill_amount + $connection_charge - $month_amount);
                            }

                            else
                            {
                                $due = DB::table('customers')
                                    ->where('id',$custId)
                                    ->first();
                            }
                            ?>

                            <td>{{++$i}}</td>
                            <td>{{ $billing->month }}</td>
                            <td>{{ $billing->payment_description }}</td>
                            <td>{{ $billing->customer_name }}</td>
                            <td>{{ $billing->ip_address }}</td>
                            <td>{{ $users->username }}</td>
                            <td>{{ $billing->payment_amount }}</td>
                                <td>{{ $new }}</td>
                                <td>
                                   <?php


                                     $flag=$billing->payment_amount-$new;

                                     $sum=$sum+$flag;
                                    echo $sum;

                                ?>
                                </td>
                              <td>  <input type="hidden" value="{{ $billing->customer_id }}" name="customer_id">
                                <a href="{{ route('show-billing',['$custId'=>$billing->customer_id]) }}"class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>

                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
    <!-- end: page -->

@endsection
