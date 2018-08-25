@extends('superadmin.master')

@section('title')
    New Customer
@endsection

@section('content')
    {{ date('Y-m-d H:i:s') }}


    <section class="card">
        <div class="container">

            <header class="card-header">
                <h3>{{Session::get('message')}}</h3>
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
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Connection Date</th>
                        <th>Mobile Number</th>
                        <th>Speed</th>
                        <th>Bill</th>
                        <th>Connection Charge</th>
                        <th>IP</th>
                         <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->connection_date}}</td>
                            <td>{{ $customer->mobile_no }}</td>
                            <td>{{ $customer->speed}}</td>
                            <td>{{ $customer->bill_amount	}}</td>
                            <td>{{ $customer->connection_charge}}</td>
                            <td>{{ $customer->ip_address}}</td>
                            <td class="center">
                                <input type="hidden" value="{{ $customer->customerId }}" name="customerId">
                                <a href="{{ url('billing/edit/'.$customer->customerId) }}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
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
