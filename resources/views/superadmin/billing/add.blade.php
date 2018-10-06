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
							<b>View Customer Billing Information <?php $date = \Carbon\Carbon::now();
                                echo $date->format('F');
                                ?></b>
						</div>
						<div class="col-md-4" style="font-family: Helvetica;">
							<div class="col-md-">
								<b>Total Bill Amount</b>
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
			<div class="row" style="margin-bottom:10px;">
				<div class="col-md-4">
					<div class="btn-group" role="group">
						<a class="btn btn-info btn-sm" id="print_link" href="?q=view_report_paganition&flag=INVOICE"
						   target="_blank">Print
							Invoice</a>
					</div>
				</div>
				<div class="col-md-4 col-md-offset-4">
					<select id="zone_id" type="zone_id" class="form-control"
							name="zone_id" required>
						<option>--Select a Zone---</option>

						@foreach ($zones as $value)
							<option value="{{$value->id}}" > {{$value->zone_name}}</option>
						@endforeach
					</select>

				</div>

				<div class="col-md-4 col-md-offset-4">
					<form>
						<div class="input-group">
							<input type="search_text" name="search_text" id="search_text" class="form-control" placeholder="Search for...">
						</div>
					</form>
				</div>

			</div>


       <section class="card">
		   <div class="card-body">
		<table class="table table-bordered table-striped mb-0 table-responsive" id="datatable-editable">

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
                    <?php
                    $date = Carbon\Carbon::parse(($customer->connection_date));
                    $now = Carbon\Carbon::now();

                    $diff = $date->diffInMonths($now);

                    ?>
					@if($diff > 0)

						<td>{{ ++$i }}</td>
 <td><a href="{{ route('pdf',['id'=>$customer->id]) }}" target="_blank" class="btn btn-outline-info "><i class="fas fa-invoice"></i> Print</a>	</td>

							<td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->address }}</td>
							<td>{{ $customer->zone_name }}</td>
							<td>{{ $customer->mobile_no }}</td>
							<td>{{ $customer->speed}}</td>
							<td>{{ $customer->bill_amount	}}</td>
							<td>{{ $customer->ip_address}}</td>

					<td>
                        <?php $lifetime_paid=DB::table('billings')->where('customer_id',$customer->id)->sum('payment_amount'); ?>
                        <?php
                        $flag=$customer->bill_amount;
                        $flag1 = $customer->month_amount;

                        $sum=$flag - $flag1;
                        ?>

                        <?php
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

                        ?>
					</td>

					<td>

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

						{{$due}}</td>


					<td class="center">
						<input type="hidden" value="{{ $customer->id }}" name="customer_id">

						<a class="btn-facebook" href="{{ url('billing/edit/'.$customer->id) }}">Edit</a>

						@if($customer->bill_status == 0)

							<form action="{{ route('show-unpaid') }}" method="POST">
								{{ csrf_field() }}
								<input type="hidden" value="{{$customer->id}}}" name="id">
									<button type="submit" onclick="return confirm('Are u sure want to unpaid this !!!')"
										class="mb-1 mt-1 mr-1 btn btn-info">Unpaid</button>
							</form>

						@else
							<form action="{{ route('show-paid') }}" method="POST">
								{{ csrf_field() }}
								<input type="hidden" value="{{$customer->id}}}" name="id">
								<button type="submit" onclick="return confirm('Are u sure want to paid this !!!')"
										class="mb-1 mt-1 mr-1 btn btn-outline-success">Paid</button>
							</form>

						@endif
					</td>
				</tr>
				@else

				@endif

			</tbody>

    @endforeach
		</table>
		{{ $customers->links() }}
	</div>
</section>
<!-- end: page -->

@endsection
