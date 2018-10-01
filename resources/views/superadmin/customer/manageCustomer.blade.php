@extends('superadmin.master')

@section('title')
    Customer Info
@endsection

@section('content')

    <section class="card">
        <div class="container">

            <header class="card-header">
                <h2 class="card-title">View Customer Information</h2>
                <br/>
                <br/>



                       <div class="pull-right">
                           <select id="zone_id" type="zone_id" class="form-control"
                                   name="zone_id" required>
                               @foreach ($zones as $value)
                                   <option value="{{$value->id}}" > {{$value->zone_name}}</option>
                               @endforeach
                           </select>

                           <form method="GET">
                               <input type="text" name="name">
                               <input type="checkbox" name="hasCoffeeMachine" value="1"><span> Apply Filter</span>
                           </form>
                       </div>

            </header>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="pull-right">
                        <a class="btn btn-default" href="{{ route('show-actives') }}"> Only Active </a>
                        <a class="btn btn-default" href="{{ route('show-inactives') }}"> Only InActive </a>
                        <div class="pull-right">
                            <a class="btn btn-default" href="{{ route('create-user') }}"> Create user </a>
                        </div>
                        </div>
                </div>
            </div>
            <br/>
            <br/>
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
                        <td> {{ $customer->zone_id }}</td>
                        <td>{{ $customer->ip_address}}</td>
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

        </div>
        </div>
    </section>
    <!-- end: page -->
@endsection
