@extends('superadmin.master')

@section('title')
    New Customer
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <?php $date = \Carbon\Carbon::now();
                    ?>
                    <b>New Joining Customer Information
                    </b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">

                    </div>
                </div>
                <div class="col-md-4">
                    <div style="float:right; padding-right:10px">
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-12"
         style=" background:#606060; margin-top:10px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">

        <div class="form-group">
            <form action="{{route('filter')}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-1 text-center">
                        <label class="text-white">Date</label>
                    </div>
                    <div class="col-md-4">
                        <input type="date" class="form-control" name="startDate">
                    </div>

                    <div class="col-md-1 text-center">
                        <span>To</span>
                    </div>
                    <div class="col-md-4">
                        <input type="date" class="form-control" name="endDate">
                    </div>

                    <div class="col-md-2">
                        <input type="submit" class="btn btn-success btn-block" name="btnSearch" value="Search">
                    </div>
                </div>
            </form>

        </div>
    </div>


    <section class="card">
        <div class="col-sm-6" >
            <div class="pull-right">
                <button type="submit" class="btn btn-info pull-right" onclick="printDiv('month_print')">Print Statement</button>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12" >
                <h2 style="text-align:center;"> <?php $date = \Carbon\Carbon::now();
                    echo $date->format('F Y');
                    ?>
                </h2>
            </div>
            <div class="col-md-12" >
                <div class="row text-center">
                    <div class="col-md-4 btn-info text-center full">
                        <h3>{{$count}}</h3>
                        <h3>All</h3>
                    </div>
                    <div class="col-md-4 btn-info text-center full" style="background-color:#678bd3;">
                        <h3>{{$count1}}</h3>
                        <h3>Active</h3>
                    </div>
                    <div class="col-md-4 btn-danger text-center full">
                        <h3>{{$count2}}</h3>
                        <h3>Inactive</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Connection Date</th>
                        <th>Mobile Number</th>
                        <th>Speed</th>
                        <th>Bill</th>
                        <th>Connection Charge</th>
                        <th>IP</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $customer)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->connection_date}}</td>
                            <td>{{ $customer->mobile_no }}</td>
                            <td>{{ $customer->speed}}</td>
                            <td>{{ $customer->bill_amount	}}</td>
                            <td>{{ $customer->connection_charge}}</td>
                            <td>{{ $customer->ip_address}}</td>
                            <td class="center">

                                <a class=" btn-info" href="{{ url('billing/edit/'.$customer->id) }}">Edit</a>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
            {{--<div class="pull-right">{{ $customers->links() }}</div>--}}
        </div>
    </section>


@endsection
