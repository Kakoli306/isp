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

                    @foreach($bills as $customer)
                        <tr>
                            <td></td>
                            <td>{{$customer->dates}}</td>
                            <td>{{$customer->sums}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    @endforeach

                    <tbody>
                    @foreach($con as $conn)
                        <tr>
                            <td></td>
                            <td>{{$conn->dates}}
                            <td></td>
                            <td>{{$conn->charge}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                    @endforeach

                    <tbody>
                    @foreach($income as $in)
                        <tr>
                            <td></td>
                            <td>{{$in->dates}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$in->incomes}}</td>
                        </tr>
                    </tbody>
                    @endforeach

                    <tbody>
                    @foreach($expenses as $exp)
                        <tr>
                            <td></td>
                            <td>{{$conn->dates}}
                            <td></td>
                            <td>{{$conn->charge}}</td>
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