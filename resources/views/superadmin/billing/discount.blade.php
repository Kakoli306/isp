@extends('superadmin.master')

@section('title')
    Discount
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
                        <th>Customer Name</th>
                        <th>Amount</th>
                        <th>Taken By</th>
                    </tr>
                    </thead>
                    <tbody>



                        @foreach($customers as $billing)
                        <tr>
                            <td>{{ $billing->id }}</td>
                            <td>{{ $billing->created_at }}</td>
                            <td>{{ $billing->customer_name }}</td>
                            <td>{{ $billing->payment_amount }}</td>
                            <td>{{ $users->username }}</td>


                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
    <!-- end: page -->

@endsection
