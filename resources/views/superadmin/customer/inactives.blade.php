@extends('superadmin.master')

@section('title')
    Only InActive
@endsection

@section('content')

    <section class="card">
        <div class="container">

            <header class="card-header">
                <h2 class="card-title">View Active Customer Information</h2>
            </header>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12"
                         style=" background:#180c22; margin-top:15px; margin-bottom: 10px; min-height:40px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
                        <div class="col-md-6">
                            <b>View Customer Information</b>
                        </div>
                        <div class="col-md-12" style="">
                            <a class="btn btn-info btn-sm pull-right" href="{{route('add-customer') }}">ADD NEW<span class="glyphicon glyphicon-plus"></span></a>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="pull-right">
                            <a class="btn btn btn-default" href="{{ route('show-actives') }}"> Only Active </a>
                            <a class="btn btn-outline-info" href="{{ route('show-inactives') }}"> Only InActive </a>
                            <a class="mb-1 mt-1 mr-1 btn btn-default" href="{{ route('manage-customer') }}"> View all </a>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <form action="/search" method="POST" role="search">
                            {{ csrf_field() }}

                            <div class="input-group">
                                <select id="zone_id" type="zone_id" class="form-control"
                                        name="zone_id" required>
                                    <option>--Select a Zone---</option>

                                    @foreach ($zones as $value)
                                        <option value="{{$value->id}}" > {{$value->zone_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="summary">
                            <h4 class="title">Total Bill Amount : {{$sun}}</h4>
                            <div class="info">
                                <strong class="amount"></strong>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="pull-right">
                                <div class="col-md-4">
                                    <a href="?q=printclient" id="print_link" target="_blank" class="btn btn-info btn-xs pull-right" >Print Client List</a>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3" style="">
                            <form>
                                <div class="input-group">
                                    <input type="search_text" name="search_text" id="search_text" class="form-control" placeholder="Search for...">
                                </div>
                            </form>
                        </div>


                        <table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">

                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Customer ID</th>
                        <th>Address</th>
                        <th>Mobile Number</th>
                        <th>Speed</th>
                        <th>Bill</th>
                        <th>Connection Date</th>
                        <th>Zone</th>
                        <th>IP</th>
                        <th>Status</th>
                        <th>Customer Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->mobile_no }}</td>
                            <td>{{ $customer->speed}}</td>
                            <td>{{ $customer->bill_amount	}}</td>
                            <td>{{ $customer->connection_date}}</td>
                            <td>{{ $customer->zone_id }}</td>
                            <td>{{ $customer->ip_address}}</td>
                            <td>{{ $customer->status == 1 ? 'Active' : 'Inactive' }}</td>

                            <td class="center">
                                @if($customer->status == 1)

                                    <form action="{{ route('inactive-customer',['id'=>$customer->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" name="btn"  class="btn btn-danger btn-sm">Inactive</button>
                                    </form>

                                @else
                                    <form action="{{ route('active-customer',['id'=>$customer->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" name="btn"  class="btn btn-success btn-sm">active</button>
                                    </form>

                            @endif

                            <td class="center">
                                <input type="hidden" value="{{ $customer->id }}" name="customerId">
                                <a href="{{ route('edit',['id'=>$customer->id]) }}" class="on-default edit-row">
                                    <i class="fas fa-pencil-alt"></i></a>

                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                {{ $customers->links() }}

            </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: page -->

@endsection
