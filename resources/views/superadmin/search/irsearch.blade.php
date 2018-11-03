@extends('superadmin.master')
@section('title')
    Income Report
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <?php $date = \Carbon\Carbon::now();
                    ?>
                    <b>Monthly Income Sheet of <?php echo $date->format('F Y'); ?></b>
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
            <form action="{{route('idfiter')}}" method="post">
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

        </div>

        <div class="row">

            <div class="col-md-12" >
                <h2 style="text-align:center;"> <?php $date = \Carbon\Carbon::now();
                    echo $date->format('F Y');
                    ?>
                </h2>
            </div>
            <div class="col-md-12" id="month_print">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Bill Collection</th>

                    </tr>
                    </thead>
                    <tbody>

                    <tbody>

                    @foreach($data as $customer)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $customer->month}}</td>
                            <td>{{ $customer->payment_amount }}</td>

                        </tr>
                    </tbody>
                    @endforeach

                </table>
            </div>

        </div>

    </section>


@endsection