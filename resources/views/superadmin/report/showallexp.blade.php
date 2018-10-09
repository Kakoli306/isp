@extends('superadmin.master')

@section('title')
    Daily Account Statement
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-12">
                    <?php $date = \Carbon\Carbon::now();
                    ?>

                    <b>The Accounting Statement of <?php echo $date->format('F Y'); ?> only Billing Information
                    </b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">
                    </div>
                </div>
                <div class="col-md-8">
                    <div style="float:right; padding-right:10px">
                        <a class="btn btn-success btn-sm" href=" ">Print Statement <span class="glyphicon glyphicon-plus"></span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12"
         style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">


        <div class="form-group row">
            <label class="col-lg-3 control-label text-lg-right pt-2 ">previous Date</label>
            <div class="col-lg-6">
                <div class="input-daterange input-group">

                    <input type="text" class="form-control" name="start">
                    <span class="input-group-text border-left-0 border-right-0 rounded-0">
															Next Date
														</span>
                </div>
            </div>

        </div>


    </div>

    <section class="card">
        <div class="container">

            <div class="card-body">


                <table class="table table-bordered table-striped mb-0" id="datatable-default">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Account Head</th>
                        <th>Description</th>
                        <th>Expense</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($billings as $billing)
                        <tr>
                            <td></td>
                            <td>{{ $billing->date }}</td>
                            <td>{{ $billing->name }}</td>
                            <td>{{ $billing->description }}</td>
                            <td>{{ $billing->price }}</td>

                        </tr>
                    </tbody>
                    @endforeach


                </table>
            </div>
        </div>
    </section>
    <!-- end: page -->

@endsection