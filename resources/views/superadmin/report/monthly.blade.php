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
                                @foreach($merged as $customer)
                                    <a style="color: RoyalBlue;" href="{{ url('/con/date/'.Carbon\Carbon::parse($customer->dates)->format('Y-m-d ')) }}">{{ $customer->charge }}</a>
                                @endforeach
                            </td>

                            <td>
                                @foreach($merged as $customer)
                                    <a style="color: RoyalBlue;"  href="{{ url('/inc/date/'.Carbon\Carbon::parse($customer->dates)->format('Y-m-d ')) }}">{{ $customer->incomes }}</a>
                                @endforeach
                            </td>

                            <td>
                                @foreach($merged as $customer)
                                    <a style="color: RoyalBlue;" href="{{ url('/exp/date/'.Carbon\Carbon::parse($customer->dates)->format('Y-m-d ')) }}">{{ $customer->expenses }}</a>
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