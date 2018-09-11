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
                        <th>Billing</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($billings as $billing)
                        <tr>
                            <td>{{ $billing->id }}</td>
                            <td>{{ $billing->connection_date  }}<a href="{{ url('daily/'.$billing->connection_date) }}" class="on-default edit-row">
                                    <i class="fas fa-pencil-alt"></i></a></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$billing->month}}</td>
                            <td class="center">
                                <?php
                               $date = $billing->month;
                                ?>
                                <a href="{{ url('daily/'.$date) }}" class="on-default edit-row">
                                    <i class="fas fa-pencil-alt"></i></a>
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