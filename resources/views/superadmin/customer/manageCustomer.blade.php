@extends('superadmin.master')

@section('title')
    Customer Info
@endsection

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <div class="row">

        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <?php $date = \Carbon\Carbon::now();
                    ?>
                    <b>View Customer Information
                    </b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">

                        @if(session("message"))
                            <strong>{{session('message')}}</strong>
                            @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="float:right; padding-right:10px">
                        <a id="print_client_bill" class="btn btn-info btn-sm"
                           href="">Add Customer <span class="glyphicon glyphicon-print"></span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <section class="card">
        <div class="card-body">
            <div class="text-left;">
                <script>
                    function goBack() {
                        window.history.back()
                    }
                </script>

                <button onclick="goBack()"><i class="fas fa-arrow-left"></i> </button>

            </div>

            <div class="row">
                <div class="col-sm-8">
                    <div class="pull-right">
                        <a class="mb-1 mt-1 mr-1 btn btn-outline-info" href="{{ route('manage-customer') }}"> View all </a>
                        <a class="btn btn-default" href="{{ route('show-actives') }}"> Only Active </a>
                        <a class="btn btn-default" href="{{ route('show-inactives') }}"> Only InActive </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <form>

                        <div class="input-group">
                        <select id="zone_id" type="zone_id" class="form-control"
                                name="zone_id" required>
                            <option>--Select a Zone---</option>

                            @foreach ($zones as $value)
                                <option value="{{$value->zone_name}}" > {{$value->zone_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row" style="margin-bottom:10px;">
                <div class="col-md-4">
                    <div class="summary">
                        <h4 class="title">Total Bill Amount : {{$sun}}</h4>
                        <div class="info">
                            <strong class="amount"></strong>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 col-md-offset-4">

                </div>

                <div class="col-md-4 col-md-offset-4">
                    <form>
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search Customer...">
                        </div>
                    </form>
                </div>

            </div>


            <div class="card-body">
                <div class="row">

                    <table class="table table-bordered">
                        <h3 align="center">Total Data : <span id="total_records"></span></h3>

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
                        <th width="280px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    {{--@foreach($customers as $customer)--}}
                        {{--<tr>--}}
                            {{--<td>{{ ++$i }}</td>--}}
                            {{--<td>{{ $customer->customer_name }}</td>--}}
                            {{--<td>{{ $customer->id }}</td>--}}
                            {{--<td>{{ $customer->address }}</td>--}}
                            {{--<td>{{ $customer->mobile_no }}</td>--}}
                            {{--<td>{{ $customer->speed}}</td>--}}
                            {{--<td>{{ $customer->bill_amount	}}</td>--}}
                            {{--<td>{{ $customer->connection_date}}</td>--}}
                            {{--<td> {{ $customer->zone_name }}</td>--}}
                            {{--<td>{{ $customer->ip_address}}</td>--}}
                            {{--<td class="center">--}}
                                {{--@if($customer->status == 1)--}}

                                    {{--<a class=" btn-info" href="{{ url('customer/inactive/'.$customer->id) }}">Inactive</a>--}}

                                {{--@else--}}
                                    {{--<a class=" btn-info" href="{{ route('active-customer',['id'=>$customer->id]) }}">active</a>--}}


                                {{--@endif--}}
                                {{--@if($customer->status == 1)--}}

                                    {{--<form action="{{ route('inactive-customer',['id'=>$customer->id]) }}" method="POST">--}}
                                        {{--{{ csrf_field() }}--}}
                                        {{--<button type="submit" name="btn"  class="btn btn-danger btn-sm">Inactive</button>--}}
                                    {{--</form>--}}

                                {{--@else--}}
                                    {{--<form action="{{ route('active-customer',['id'=>$customer->id]) }}" method="POST">--}}
                                        {{--{{ csrf_field() }}--}}
                                        {{--<button type="submit" name="btn"  class="btn btn-success btn-sm">active</button>--}}
                                    {{--</form>--}}

                                {{--@endif--}}
                            {{--</td>--}}

                            {{--<td class="center">--}}
                                {{--<a class=" btn-info" href="{{ route('edit',['id'=>$customer->id]) }}">Edit</a>--}}
                                {{--<form action="{{ route('delete') }}"  title="Delete" >--}}


                                    {{--<input type="hidden" value="{{$customer->id}}" name="customer_id">--}}
                                    {{--<button type="submit" name="btn" onclick="return confirm('Are u sure to delete this !!!')"--}}
                                            {{--class="btn-outline-danger">Delete--}}
                                    {{--</button>--}}
                                {{--</form>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--</tbody>--}}
                    {{--@endforeach--}}

                </table>

                </div>

        </div>
            <div class="pull-right">{{ $customers->links() }}</div>

        </div>

    </section>
    <!-- end: page -->


    <script>
        $(document).ready(function(){

            fetch_paid_data();

            function fetch_paid_data(query = '')
            {
                $.ajax({
                    url:"{{ route('search.action') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }

            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                fetch_paid_data(query);
            });

            $(document).on('change', '#zone_id', function(){
                var query = $(this).val();
                console.log(query);
                fetch_paid_data(query);
            });
        });
    </script>


@endsection
