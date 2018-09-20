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
                    @foreach($res as $key => $merged)
                        <tr>
                            <td></td>
                            <td>{{ $key  }}</td>
                    <td>
                            @foreach($merged as $customer)

                                <a href="{{ url('/daily/date/'.Carbon\Carbon::parse($customer->dates)->format('Y-m-d ')) }}">{{ $customer->sums }}</a>

                            @endforeach
                        </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- end: page -->

@endsection