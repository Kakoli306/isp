@extends('superadmin.master')

@section('title')
Bill Collection
@endsection

@section('content')
	<div class="row">
				<div class="col-md-12 "
					 style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
					<div class="row">
						<div class="col-md-4">
							<b>View Customer Billing Information </b>
						</div>
						<div class="col-md-4" style="font-family: Helvetica;">
							<div class="col-md-">
                                <?php $bill=DB::table('billings')->sum('payment_amount'); ?>
								<b>Total Bill Amount {{$bill}}

								</b>
							</div>
						</div>
						<div class="col-md-4">
							<div style="float:right; padding-right:10px">
								<a id="print_client_bill" class="btn btn-info btn-sm"
								   href="?q=print_client_bill">Print
									Client Bill <span class="glyphicon glyphicon-print"></span></a>
								<a class="btn btn-info btn-sm" href="{{route('add-customer') }}">Add New <span class="glyphicon glyphicon-plus"></span></a>
							</div>
						</div>

					</div>
				</div>
			</div>


       <section class="card">
		   <div class="card-body">
			   <div class="row">

				   <div class="col-sm-8">
					   <div class="text-left;">
						   <script>
                               function goBack() {
                                   window.history.back()
                               }
						   </script>

						   <button onclick="goBack()"><i class="fas fa-arrow-left"></i> </button>

					   </div>

					   <div class="pull-right">

                           <?php $date = \Carbon\Carbon::now();
                           ?>
						   <b>View <?php echo $date->format('F Y'); ?> Billing Information</b>

					   </div>
				   </div>

				   <div class="col-md-4">
					   <form action="/search" method="POST" role="search">
						   {{ csrf_field() }}

						   {{--<div class="input-group">--}}
							   {{--<select id="zone_id" type="zone_id" class="form-control"--}}
									   {{--name="zone_id" required>--}}
								   {{--<option>--Select a Zone---</option>--}}

								   {{--@foreach ($zones as $value)--}}
									   {{--<option value="{{$value->id}}" > {{$value->zone_name}}</option>--}}
								   {{--@endforeach--}}
							   {{--</select>--}}
						   {{--</div>--}}
					   </form>
				   </div>
			   </div>

			   <div class="row" style="margin-bottom:10px;">
				   <div class="col-md-4">
					   <div class="summary">
						   <a id="print_client_bill" class="btn btn-info btn-sm"
							  href="?q=print_client_bill">Print Invoice<span class="glyphicon glyphicon-print"></span></a>
						   <div class="info">
							   <strong class="amount"></strong>
						   </div>
					   </div>

				   </div>

				   <div class="col-md-4 col-md-offset-4">

				   </div>

				   <div class="col-md-4 col-md-offset-4">
					   {{--<form>--}}
						   {{--<div class="input-group">--}}
							   {{--<input type="search_text" name="search_text" id="search_text" class="form-control" placeholder="Search for...">--}}
						   {{--</div>--}}
					   {{--</form>--}}
				   </div>

			   </div>
				 <div class="row" style="margin-bottom:10px;">
				 	<div class="col-md-12 ">
			   <table class="table table-bordered">
				   {{--<h3 align="center">Total Data : <span id="total_records"></span></h3>--}}

			<thead>
			<tr>
				<th>No</th>
				<th>Invoice</th>
				<th>Customer Name</th>
				<th>Customer ID</th>
				<th>Address</th>
				<th>Zone</th>
				<th>Mobile Number</th>
				<th>Speed</th>
				<th>Bill</th>
				<th>IP</th>
				<th>Previous Due</th>
				<th>Total Dues</th>
				<th>Actions</th>
			</tr>
			</thead>

			<tbody>

			@foreach($customers as $customer)

				<tr>
                    <?php $lifetime_paid=DB::table('billings')->where('customer_id',$customer->id)->sum('payment_amount'); ?>

                    <?php

                    $date = Carbon\Carbon::parse(($customer->connection_date));
                    $now = Carbon\Carbon::now();

                    $diff = $date->diffInMonths($now);
                    $a =$diff * $customer->bill_amount;

                    $flag=$customer->bill_amount;
                    $flag1 = $customer->month_amount;

                    $sum=$flag - $flag1;

                    $pay = $lifetime_paid;
                    $ok = $pay - $sum;

                    $due = $a - $ok;

                    //dd($due);
                    ?>
						@if($due != 0)

						<?php
                    $date = Carbon\Carbon::parse(($customer->connection_date));
                    $now = Carbon\Carbon::now();

                    $diff = $date->diffInMonths($now);

                    ?>

					@if($diff > 0)

						<td>{{ ++$i }}</td>
                           <td style="color: RoyalBlue;"><a style="color: RoyalBlue;" href="{{ url('downloadPDF',['id'=>$customer->id]) }}" target="_blank"><i class="fas fa-print"></i></a></td>
							<td>{{ $customer->customer_name }}</td>
							<td style="color: RoyalBlue;">
								<a style="color: RoyalBlue;" href="{{ url('/billing/showing/'.$customer->id) }}">{{$customer->id}}</a>
							</td>
                            <td>{{ $customer->address }}</td>
							<td>{{ $customer->zone_name }}</td>
							<td>{{ $customer->mobile_no }}</td>
							<td>{{ $customer->speed}}</td>
							<td>{{ $customer->bill_amount	}}</td>
							<td>{{ $customer->ip_address}}</td>

					<td>

                        <?php
                        if  ($due == 0 )

                        {
                           echo $predue = 0;

                        }
                         else

                        {

                        $date = Carbon\Carbon::parse(($customer->connection_date));
						$now = Carbon\Carbon::now()->subMonth();

						$diff = $date->diffInMonths($now);

                        $a =$diff * $customer->bill_amount;

                        $flag=$customer->bill_amount;
                        $flag1 = $customer->month_amount;

                        $sum=$flag - $flag1;

                        $pay = $lifetime_paid;
                        $ok = $pay - $sum;
                        $predue = $a - $ok;

                        echo $predue;
                     }

                        ?>
					</td>

					<td>{{$due}}</td>

							<td class="center">
							@if($customer->bill_status == 0)

							{{--<form action="{{ route('show-unpaid') }}" method="POST">--}}
								{{--{{ csrf_field() }}--}}
								{{--<input type="hidden" value="{{$customer->id}}}" name="id">--}}
									{{--<button type="submit" onclick="return confirm('Are u sure want to unpaid this !!!')"--}}
										{{--class="btn-outline-success">Unpaid</button>--}}
							{{--</form>--}}

						@else

									<form action="{{route('show-paid')}}" method="POST">
								{{ csrf_field() }}

										<input type="hidden" value="{{ $customer->id }}" name="customer_id">

										<a class="btn-outline-info" href="{{ url('billing/edit/'.$customer->id) }}">Edit</a>


										<input type="hidden"  name="amount" value="{{$customer->bill_amount}}">

										<input type="hidden" value="{{$customer->id}}" name="customer_id">
								<button type="submit" onclick="return confirm('Are u sure want to paid {{$customer->bill_amount}}!!!')"
										class="btn-outline-primary">Paid</button>
							</form>

						@endif
								@else
								@endif

							</td>
				</tr>
				@else
				@endif

			</tbody>

    @endforeach
		</table>
	</div>
	</div>
			   <div class="pull-right">{{ $customers->links() }}</div>
	</div>
</section>
<!-- end: page -->
	{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}


	{{--<script>--}}
        {{--$(document).ready(function(){--}}

            {{--fetch_customer_data();--}}

            {{--function fetch_customer_data(query = '')--}}
            {{--{--}}
                {{--$.ajax({--}}
                    {{--url:"{{ route('billsearch') }}",--}}
                    {{--method:'GET',--}}
                    {{--data:{query:query},--}}
                    {{--dataType:'json',--}}
                    {{--success:function(data)--}}
                    {{--{--}}
                        {{--$('tbody').html(data.table_data);--}}
                        {{--$('#total_records').text(data.total_data);--}}
                    {{--}--}}
                {{--})--}}
            {{--}--}}

            {{--$(document).on('keyup', '#search', function(){--}}
                {{--var query = $(this).val();--}}
                {{--fetch_customer_data(query);--}}
            {{--});--}}

            {{--$(document).on('change', '#zone_id', function(){--}}
                {{--var query = $(this).val();--}}
                {{--console.log(query);--}}
                {{--fetch_customer_data(query);--}}
            {{--});--}}
        {{--});--}}
	{{--</script>--}}


@endsection
