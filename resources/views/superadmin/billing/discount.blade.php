@extends('superadmin.master')

@section('title')
    Discount
@endsection

@section('content')


    <section class="card">
        <div class="container">

            <div id="editbodyload" class="col-md-12" style="  background:#FFFFFF; border:1px solid #999999;"
                 id="bodyload">


                <div class="col-md-12" style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
                    <div class="col-md-6">
                        <b>View Discount Information</b>
                    </div>
                </div>

            </div>
            <br/>

            <div class="card-body">
            <div class="row">

                    <div class="col-sm-8">
                    </div>

                    <div class="col-md-4">
                        <form action="/search" method="POST" role="search">
                            {{ csrf_field() }}

                            <div class="input-group">
                                <input type="search_text" name="search_text" id="search_text" class="form-control" placeholder="Search for...">
                            </div>
                        </form>
                    </div>




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
                        <th>Customer Name</th>
                        <th>Amount</th>
                        <th>Taken By</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($customers as $billing)
                        <tr>
                            <td>{{  ++$i  }}</td>
                            <td>{{ Carbon\Carbon::parse($billing->created_at)->format('d-m-Y') }}</td>
                            <td>{{ $billing->customer_name }}</td>
                            <td>{{ $billing->payment_amount }}</td>
                            <td><a style="color: RoyalBlue;" href="{{ route('user-details',['id'=>$users->userId])  }}"> {{ $users->username }}</td></a>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                {{ $customers->links() }}

            </div>
        </div>
        </div>
    </section>
    <!-- end: page -->

@endsection
