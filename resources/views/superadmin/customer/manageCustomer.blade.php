@extends('superadmin.master')

@section('title')
    Customer Info
@endsection

@section('content')

    <section class="card">
        <div class="container">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            <header class="card-header">
            <h3>{{Session::get('message')}}</h3>
            <h2 class="card-title">View Customer Information</h2>
        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <a href="{{ route('show-actives')}}" class="on-default edit-row">Only Active</a>
                    </div>

                    <div class="mb-3">
                        <a href="{{ route('show-inactives')}}" class="on-default edit-row">Only InActive</a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">

                <thead>
                <tr>
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
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->mobile_no }}</td>
                        <td>{{ $customer->speed}}</td>
                        <td>{{ $customer->bill_amount	}}</td>
                        <td>{{ $customer->connection_date}}</td>
                        <td> {{ $customer->zone_id }}</td>
                        <td>{{ $customer->ip_address}}</td>
                        <td>{{ $customer->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td class="center">
                            @if($customer->status == 1)

                                <form action="{{ route('inactive-customer',['id'=>$customer->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary btn-sm" title="Inactive">
                                        <i class="fas fa-arrow-alt-circle-up"></i></a>
                                    </button>
                                </form>

                            @else
                                <form action="{{ route('active-customer',['id'=>$customer->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-warning btn-sm" title="Active">
                                        <i class="fas fa-arrow-alt-circle-down"></i></a>
                                    </button>
                                </form>

                        @endif

                        <td class="center">
                            <input type="hidden" value="{{ $customer->id }}" name="customer_id">
                            <a href="{{ route('edit',['id'=>$customer->id]) }}" class="on-default edit-row">
                                <i class="fas fa-pencil-alt"></i></a>

                            <form action="{{ route('delete') }}" method="POST" style ="..." data-toggle="tooltip" title="Delete" >
                                {{csrf_field()}}

                                <input type="hidden" value="{{$customer->id}}" name="customer_id">
                                <button type="submit" name="btn" onclick="return confirm('Are u sure to delete this !!!')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            </form>

                            <!--<a href="{{ route('delete',['id'=>$customer->customerId] )}}" class="on-default edit-row"><i class="fas fa-arrows-alt-v"></i></a> -->
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
