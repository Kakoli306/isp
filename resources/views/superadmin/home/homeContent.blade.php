@extends('superadmin.master')
@section('title')
isp-management
@endsection
@section('content')

	<!-- start: page -->
		<div class="row">
			<div class="col-lg-6">
				<section class="card">
					<header class="card-header">
						<div class="card-actions">
							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
							<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
						</div>

						<h2 class="card-title">Basic</h2>
					</header>
					<div class="card-body">
						<table class="table table-responsive-md mb-0">
							<thead>
							<tr>
								<th>#</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Username</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>1</td>
								<td>Mark</td>
								<td>Otto</td>
								<td>@mdo</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Jacob</td>
								<td>Thornton</td>
								<td>@fat</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Larry</td>
								<td>the Bird</td>
								<td>@twitter</td>
							</tr>
							</tbody>
						</table>
					</div>

					<div class="card-body">
						<table class="table table-responsive-md mb-0">
							<thead>
							<tr>
								<th>#</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Username</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>1</td>
								<td>Mark</td>
								<td>Otto</td>
								<td>@mdo</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Jacob</td>
								<td>Thornton</td>
								<td>@fat</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Larry</td>
								<td>the Bird</td>
								<td>@twitter</td>
							</tr>
							</tbody>
						</table>
					</div>

				</section>
			</div>

			<div class="col-lg-6">
	       <div class="row mb-3">
		<div class="col-xl-6">
			<section class="card card-featured-left card-featured-primary mb-3">
				<div class="card-body">
					<div class="widget-summary">
						<div class="widget-summary-col widget-summary-col-icon">
							<div class="summary-icon bg-primary">
								<i class="fas fa-life-ring"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title"> All Customers</h4>
								<div class="info">
									<strong class="amount">{{$customers}}</strong>
								</div>
							</div>
							<div class="summary-footer">
								<a class="text-muted text-uppercase" href="{{route('manage-customer')}}">Customers</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="col-xl-6">
			<section class="card card-featured-left card-featured-secondary">
				<div class="card-body">
					<div class="widget-summary">
						<div class="widget-summary-col widget-summary-col-icon">
							<div class="summary-icon bg-secondary">
								<i class="fas fa-dollar-sign"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title">Total Income</h4>
								<div class="info">
									<strong class="amount">{{$incomes}}</strong>
								</div>
							</div>
							<div class="summary-footer">
								<a class="text-muted text-uppercase" href="{{ url('income') }}">Income all</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-6">
			<section class="card card-featured-left card-featured-tertiary mb-3">
				<div class="card-body">
					<div class="widget-summary">
						<div class="widget-summary-col widget-summary-col-icon">
							<div class="summary-icon bg-tertiary">
								<i class="fas fa-shopping-cart"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title">New Users</h4>
								<div class="info">
									<strong class="amount">{{$users}}</strong>
								</div>
							</div>
							<div class="summary-footer">
								<a class="text-muted text-uppercase" href="{{route('user-show')}}">(Users)</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="col-xl-6">
			<section class="card card-featured-left card-featured-quaternary">
				<div class="card-body">
					<div class="widget-summary">
						<div class="widget-summary-col widget-summary-col-icon">
							<div class="summary-icon bg-quaternary">
								<i class="fas fa-user"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title">Total Expense</h4>
								<div class="info">
									<strong class="amount">{{$expenses}}</strong>
								</div>
							</div>
							<div class="summary-footer">
								<a class="text-muted text-uppercase" href="{{ url('expenses') }}"</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<div class="col-xl-6">
			<section class="card card-featured-left card-featured-quaternary">
				<div class="card-body">
					<div class="widget-summary">
						<div class="widget-summary-col widget-summary-col-icon">
							<div class="summary-icon bg-quaternary">
								<i class="fas fa-user"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title">Total Zone</h4>
								<div class="info">
									<strong class="amount">{{$zones}}</strong>
								</div>
							</div>
							<div class="summary-footer">
								<a class="text-muted text-uppercase" href="{{ url("/zone") }}"</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<div class="col-xl-6">
			<section class="card card-featured-left card-featured-quaternary">
				<div class="card-body">
					<div class="widget-summary">
						<div class="widget-summary-col widget-summary-col-icon">
							<div class="summary-icon bg-quaternary">
								<i class="fas fa-user"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title">Total Head</h4>
								<div class="info">
									<strong class="amount">{{$heads}}</strong>
								</div>
							</div>
							<div class="summary-footer">
								<a class="text-muted text-uppercase" href="{{ url('/product') }}">Head</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

	</div>
</div>
</div>
@endsection
