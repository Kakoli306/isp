@extends('superadmin.master')

@section('title')
    Customer Info
@endsection

@section('content')

    <section class="card">
        <div class="container">

            <header class="card-header">
            <h3>{{Session::get('message')}}</h3>

            <h2 class="card-title">View Customer Information</h2>
        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <strong class="amount"><a href="{{route('show-actives')}}"></a>Only Active</strong>
                    </div>

                    <div class="mb-3">
                        <strong class="amount"><a href="{{route('manage-customer')}}"></a>Only InActive</strong>
                    </div>
                </div>
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
                        <td> {{ $customer->zone_name }}</td>
                        <td>{{ $customer->ip_address}}</td>
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
                        </td>

                        <td class="center">
                            <input type="hidden" value="{{ $customer->id }}" name="customer_id">
                            <a href="{{ route('edit',['id'=>$customer->id]) }}" class="on-default edit-row">
                                <i class="fas fa-pencil-alt"></i></a>

                            <form action="{{ route('delete') }}" method="POST"  title="Delete" >
                                {{csrf_field()}}

                                <input type="hidden" value="{{$customer->id}}" name="customer_id">
                                <button type="submit" name="btn" onclick="return confirm('Are u sure to delete this !!!')"
                                        class="btn btn-danger btn-sm">Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            {{ $customers->links() }}

        </div>
        </div>
    </section>
    <!-- end: page -->
@endsection
