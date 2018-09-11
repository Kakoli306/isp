@extends('superadmin.master')

@section('title')
    Daily Account Statement
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

                    @foreach($billings as $billing)

                             <td></td>
                            <td>{{ $billing->month }}</td>
                            <td>{{ $billing->payment_description }}</td>
                            <td>{{ $billing->customer_name }}</td>
                            <td>{{ $billing->ip_address }}</td>
                            <td>{{ $users->username }}</td>
                            <td>{{ $billing->payment_amount }}</td>
                            <td></td>

                         </tr>
                    </tbody>
                    @endforeach


                </table>
            </div>
        </div>
    </section>
    <!-- end: page -->

@endsection