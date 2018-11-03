@extends('superadmin.master')

@section('title')
    Connection Charge
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <?php $date = \Carbon\Carbon::now();
                    ?>
                    <b>View All Connection Charge Information <?php echo $date->format('F Y'); ?></b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12"
         style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">


        <div class="form-group">
            <form action="{{route('fdl')}}" method="post">
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
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <div class="summary">

                    </div>

                </div>

                <div class="col-md-4 col-md-offset-4">

                </div>


            </div>


            <div class="card-body">
                <div class="row">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Connection Date</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Mobile Number</th>
                            <th>Speed</th>
                            <th>IP</th>
                            <th>Connection Charge</th>  </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $customer)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $customer->connection_date}}</td>
                                <td>{{ $customer->customer_name }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->mobile_no }}</td>
                                <td>{{ $customer->speed}}</td>
                                <td>{{ $customer->ip_address}}</td>
                                <td>{{ $customer->connection_charge}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    {{--<div>--}}
                        {{--<div class="pull-right">{{ $customers->links() }}</div>--}}
                    {{--</div>--}}


                </div>
            </div>
        </div>
    </section>


    <!-- end: page -->

@endsection
