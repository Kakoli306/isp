@extends('superadmin.master')

@section('title')
    Monthly Report
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
                        <th>Bill Collection</th>
                        <th>Connection Charge</th>
                        <th>Others Income</th>
                        <th>Expense</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($bills as $customer)
                        <tr>
                            <td></td>
                            <td>{{$customer->dates}}</td>
                            <td>{{$customer->sums}}

                                <a href="{{ url('daily/dates'.$customer->dates) }}" class="on-default edit-row">
                                    <i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td>
                                <?php
                                $connection = App\Customer::where('connection_date',$customer->dates)->sum('connection_charge');
                            ?>
                                {{$connection}}
                            </td>
                            <td><?php
                                $incomes = App\Income::where('created_at',$customer->dates)->sum('amount');
                                ?>
                               {{$incomes}}
                            </td>

                            <td><?php
                                $expense = App\Expense::where('created_at',$customer->dates)->sum('price');
                                ?>
                                {{$expense}}
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
    <!-- end: page -->

@endsection