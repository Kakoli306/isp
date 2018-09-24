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
                        <th>Account Head</th>
                        <th>Description</th>
                        <th>Expense</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($billings as $billing)
                        <tr>
                            <td></td>
                            <td>{{ $billing->date }}</td>
                            <td>{{ $billing->name }}</td>
                            <td>{{ $billing->description }}</td>
                            <td>{{ $billing->price }}</td>

                        </tr>
                    </tbody>
                    @endforeach


                </table>
            </div>
        </div>
    </section>
    <!-- end: page -->

@endsection