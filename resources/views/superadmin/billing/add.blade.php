@extends('superadmin.master')

@section('title')
Bill Collection
@endsection

@section('content')

<section class="card">
	<header class="card-header">


		<h2 class="card-title">View Customer Billing Information </h2>
	</header>


	<div class="card-body">
		<div class="row">
			<div class="col-sm-6">
				<div class="mb-3">
					<button id="addToTable" class="btn btn-primary">Add <i class="fas fa-plus"></i></button>
				</div>
			</div>
		</div>
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
 <td><a href="{{ route('pdf',['id'=>$customer->id]) }}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>	</td>

    <td>{{ $customer->customer_name }}</td>
    <td>{{ $customer->id }}</td>
    <td>{{ $customer->address }}</td>
    <td>{{ $customer->zone_id }}</td>
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
						<a href="{{ url('billing/edit/'.$customer->id) }}" class="on-default edit-row"><i class="fas fa-pencil-alt">
							</i></a>

						@if($customer->bill_status == 0)

							<form action="{{ route('show-unpaid') }}" method="POST">
								{{ csrf_field() }}
								<input type="hidden" value="{{$customer->id}}}" name="id">
									<button type="submit" onclick="return confirm('Are u sure want to unpaid this !!!')">
										<i class="fas fa fa-window-close">Unpaid</i></button>
							</form>

						@else
							<form action="{{ route('show-paid') }}" method="POST">
								{{ csrf_field() }}
								<input type="hidden" value="{{$customer->id}}}" name="id">
								<button type="submit" onclick="return confirm('Are u sure want to paid this !!!')">
									<i class="fas fa fa-check-square">Paid</i></button>
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
