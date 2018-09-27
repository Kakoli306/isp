@extends('superadmin.master')

@section('title')
    Yearly Report
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
                    @foreach($year as $key => $merged)
                        <tr>
                            <td></td>
                            <td style="color: RoyalBlue;"><a style="color: RoyalBlue;" href="{{ url('/new/month/'.Carbon\Carbon::parse($key)->format('Y-m')) }}">{{ $key  }}</a></td>
                            <td></td>
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

                            <td></td>

                            <td>
                                @foreach($merged as $customer)
                                    {{ $customer->expenses }}
                                @endforeach
                            </td>
                            <td></td>

                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </section>
    <!-- end: page -->

@endsection