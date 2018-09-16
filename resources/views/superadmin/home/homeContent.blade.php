@extends('superadmin.master')
@section('title')
isp-management
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
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
									<h4 class="title">Total Customer</h4>
									<div class="info">
										<strong class="amount">{{$customers}}</strong>
										<span class="text-primary"></span>
									</div>
								</div>
								<div class="summary-footer">
									<a class="text-muted text-uppercase" href="{{route('manage-customer')}}">Customer all</a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
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
									<h4 class="title">Total user</h4>
									<div class="info">
										<strong class="amount">{{$users}}</strong>
										<span class="text-primary"></span>
									</div>
								</div>
								<div class="summary-footer">
									<a class="text-muted text-uppercase" href="{{route('user-show')}}">User Show</a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<div class="col-xl-6">
				<section class="card card-featured-left card-featured-primary mb-3">
					<div class="card-body">
						<div class="widget-summary">
							<div class="widget-summary-col widget-summary-col-icon">
								<div class="summary-icon bg-primary">
									<i class="fas fa-dollar-sign"></i>
								</div>
							</div>
							<div class="widget-summary-col">
								<div class="summary">
									<h4 class="title">Total Income</h4>
									<div class="info">
										<strong class="amount">{{$incomes}}</strong>
										<span class="text-primary"></span>
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
									<h4 class="title">Total Expense</h4>
									<div class="info">
										<strong class="amount">{{$expenses}}</strong>
									</div>
								</div>
								<div class="summary-footer">
									<a class="text-muted text-uppercase" href="{{ url('expenses') }}">(Expense)</a>
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
									<h4 class="title">Total Zone</h4>
									<div class="info">
										<strong class="amount">{{$zones}}</strong>
									</div>
								</div>
								<div class="summary-footer">
									<a class="text-muted text-uppercase" href="{{ url("/zone") }}">(zone)</a>
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

<div class="row pt-4">
	<div class="col-lg-6 mb-4 mb-lg-0">
		<section class="card">
			<header class="card-header">
				<div class="card-actions">
				</div>
				<h2 class="card-title">Best Seller</h2>
					</header>

			<div class="row">
				<div class="col">
					<section class="card">
						<header class="card-header">
							<div class="card-actions">
								<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
								<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
							</div>

							<h2 class="card-title">Basic</h2>
						</header>
						<div class="card-body">
							<table class="table table-bordered table-striped mb-0" id="datatable-default">
								<thead>
								<tr>
									<th>Rendering engine</th>
									<th>Browser</th>
									<th>Platform(s)</th>
									<th class="d-lg-none">Engine version</th>
									<th class="d-lg-none">CSS grade</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>Trident</td>
									<td>Internet
										Explorer 4.0
									</td>
									<td>Win 95+</td>
									<td class="center d-lg-none">4</td>
									<td class="center d-lg-none">X</td>
								</tr>

								</tbody>
							</table>
						</div>

					</section>
	</div>
	</div>

<!-- end: page -->

@endsection
