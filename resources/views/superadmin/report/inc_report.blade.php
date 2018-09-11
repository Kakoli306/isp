@extends('superadmin.master')
@section('title')
    Income Report
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
                        <th>Customer Connection Date</th>
                        <th>Billing Date</th>
                        <th>Bill Collection</th>
                        <th>Connection Charge</th>
                        <th>Others Income</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($date as $customer)
                        <tr>
                            <td></td>
                            <td>{{$customer->connection_date}}</td>
                            <td>{{Carbon\Carbon::parse($customer->created_at)->format('d.m.Y')}}</td>
                            <td>{{$customer->payment_amount}}</td>
                            <td>{{$customer->connection_charge}}</td>
                            <td>{{$income}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                    @endforeach


                </table>
            </div>
        </div>
    </section>


@endsection