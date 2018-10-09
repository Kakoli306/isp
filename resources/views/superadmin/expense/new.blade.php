@extends('superadmin.master')

@section('title')
    Monthly Expense report
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <?php $date = \Carbon\Carbon::now();
                    ?>
                    <b>View <?php echo $date->format('F'); ?> Expense Report Sheet</b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="float:right; padding-right:10px">
                        <a id="print_client_bill" class="btn btn-info btn-sm"
                           href="">Daily Accounting Statement <span class="glyphicon glyphicon-print"></span></a>
                        <a class="btn btn-success btn-sm" href="">Print Statement <span class="glyphicon glyphicon-plus"></span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12"
         style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">


        <div class="form-group row">
            <label class="col-lg-3 control-label text-lg-right pt-2 ">Select Month</label>
            <div class="col-lg-6">
                <div class="input-daterange input-group" data-plugin-datepicker>
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></span>

                    <input type="text" class="form-control" name="start">
                    <span class="input-group-text border-left-0 border-right-0 rounded-0">
															Select Date
														</span>
                    <input type="text" class="form-control" name="end">
                </div>
            </div>

            <div class="col-lg-3">
                <button type="submit"  name="search" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
            </div>

        </div>


    </div>


    <section class="card">

                        <table class="table table-bordered">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Head</th>
                                <th>Expense</th>
                               </tr>
                            </thead>

                            <tbody>

                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <?php $all = \App\Product::where('id',$expense->heads )->first(); ?>
                                    <td style="color: RoyalBlue;">
                                        <a style="color: RoyalBlue;" href="{{ url('/product/view/'.$all->id) }}">{{$all->name}}</a>
                                    </td>
                                    <td>{{$expense->sums}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

            <div class="row">

                <div class="col-md-12 bg-slate-800">
                    <h4 class="text-center">
                        <strong><small>Total expense : </small>{{$total}}</strong>
                    </h4>
                </div>
                <div class="col-md-12 bg-grey-800">
                    <h4 class="text-center">


                        <strong><small>Balance Ammount In Word :  </small>
                        </strong>
                    </h4>
                </div>

            </div>

    </section>

    @endsection