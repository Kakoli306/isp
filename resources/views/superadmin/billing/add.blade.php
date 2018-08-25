@extends('superadmin.master')

@section('title')
Bill Collection
@endsection

@section('content')

<section class="card">
	<header class="card-header">

						
		<h2 class="card-title">View Customer Billing Information Aug</h2>
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
 <td><a href="" target="_blank" class="btn btn-primary">
 <i class="fas fa-print"></i> Print</a>	</td>
    <td>{{ $customer->customer_name }}</td>
    <td>{{ $customer->id }}</td>
    <td>{{ $customer->address }}</td>
    <td>{{ $customer->zone }}</td>
    <td>{{ $customer->mobile_no }}</td>
    <td>{{ $customer->speed}}</td>
	  <td>{{ $customer->bill_amount	}}</td>
	  <td>{{ $customer->ip_address}}</td>
					<td>{{ $customer->ip_address}}</td>
					<td>{{ $customer->ip_address}}</td>

					<td class="center">
						<input type="hidden" value="{{ $customer->id }}" name="customerId">
						<a href="{{ url('billing/edit/'.$customer->id) }}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
					</td>
				</tr>

				</tbody>

    @endforeach

		</table>
	</div>
</section>
<!-- end: page -->

@endsection
