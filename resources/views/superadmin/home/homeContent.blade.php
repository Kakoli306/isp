@extends('superadmin.master')
@section('title')
isp-management
@endsection
@section('content')

	<!-- start: page -->
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<section class="card">
					<header class="card-header">
						<div class="card-actions">
							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>

						</div>

						<h2 class="card-title">User table</h2>
					</header>


					<div class="card-body">
						<table class="table table-responsive-md mb-0">
							<thead>
							<tr>

								<th>Name</th>
								<th>IP Address</th>
								<th>Mobile Number</th>
								<th>Address</th>
							</tr>
							</thead>
							<tbody>

							@foreach($cust as $customer)
								<tr>
									<td>{{ $customer->customer_name }}</td>
									<td>{{ $customer->ip_address}}</td>
									<td>{{ $customer->mobile_no }}</td>
									<td>{{ $customer->address }}</td>

								</tr>
							</tbody>
							@endforeach

						</table>
					</div>
				</section>

				<section class="card">
					<header class="card-header">
						<div class="card-actions">
							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
						</div>

						<h2 class="card-title">Customer Table</h2>
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
				</section>

				<section class="card">
				<div class="row">
					<div class="col-md-10 col-md-offset-2">
						<section class="card card-featured-left card-featured-quaternary">
							<div class="panel panel-default">
								<div class="panel-heading"><b>myChart</b></div>
								<div class="panel-body">
									<canvas id="canvas1" height="280" width="400"></canvas>
								</div>
							</div>
						</section>
					</div>
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
		<div class="col-lg-6">
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

               <div class="col-lg-6">
                   <section class="card card-featured-left card-featured-secondary">
                       <div class="card-body">
                           <div class="widget-summary">
                               <div class="widget-summary-col widget-summary-col-icon">
                                   <div class="summary-icon bg-secondary">
                                       <i class="fas fa-life-ring"></i>
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
                                       <a class="text-muted text-uppercase" href="{{  url("/product")  }}">Income all</a>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </section>
               </div>


           </div>

	<div class="row">
		<div class="col-lg-6">
			<section class="card card-featured-left card-featured-tertiary mb-3">
				<div class="card-body">
					<div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary">
                                <i class="fas fa-life-ring"></i>
							</div>
						</div>
						<div class="widget-summary-col">
							<div class="summary">
								<h4 class="title"> Users</h4>
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

        <div class="col-lg-6">
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
                                <a class="text-muted text-uppercase" href="{{ url('expenses') }}">Expenses all</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <div class="col-lg-12">
            <section class="card card-featured-left card-featured-secondary">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i class="fas fa-life-ring"></i>
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
                                <a class="text-muted text-uppercase" href="{{  url("/zone")  }}">Zone all</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
                <br/>
                <br/>

                <section class="card">
				<div class="row">
		<div class="col-lg-10 col-md-offset-2">
			<section class="card card-featured-left card-featured-quaternary">
				<div class="panel panel-default">
					<div class="panel-heading"><b>Charts</b></div>
					<div class="panel-body">
						<canvas id="canvas" height="280" width="400"></canvas>
					</div>
				</div>
			</section>
		</div>
	</div>
				</section>
			</div>
		</div>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

<script>

    {{--var Months = new Array();--}}
    {{--var Prices = new Array();--}}
    {{--var Test = {!! json_encode($result->toArray()) !!}--}}



   {{--// console.log(Test);--}}

	{{--@foreach($result as $d)--}}

			{{--rrr.push({{$d}})--}}

	{{--@endforeach--}}

 {{--$(document).ready(function(Test){--}}
     {{--//alert(rrr);--}}
    {{--// $.get(url, function(Test){--}}
        {{--console.log(Test);--}}
        {{--Test.forEach(function(Test){--}}
        {{--// Months.push(Test.month);--}}
        {{--// Prices.push(Test.price);--}}


    {{--});--}}


    {{--var ctx = document.getElementById("canvas").getContext('2d');--}}
    {{--var myChart = new Chart(ctx, {--}}
    {{--type: 'bar',--}}
    {{--data: {--}}
    {{--labels:Months,--}}
    {{--datasets: [{--}}
        {{--label: 'Expense',--}}
        {{--data: Prices,--}}
        {{--borderWidth: 1--}}
    {{--}]--}}
    {{--},--}}
    {{--options: {--}}
    {{--scales: {--}}
    {{--yAxes: [{--}}
    {{--ticks: {--}}
    {{--beginAtZero:true--}}
    {{--}--}}
    {{--}]--}}
    {{--}--}}
    {{--}--}}
    {{--});--}}
    {{--// });--}}
    {{--});--}}


    var url = "{{url('stock/chart')}}";
    var New = new Array();
    var Amount = new Array();

    $(document).ready(function(){
        $.get(url, function(return){
            console.log(return);
            return.forEach(function(data){
                console.log(data);
                New.push(data.month);
                Amount.push(data.price);
            });
            var abc = document.getElementById("canvas").getContext('2d');
            var BChart = new Chart(abc, {
                type: 'bar',
                data: {

                    labels:New,
                    datasets: [{
                        label: 'Collection',
                        data: Amount,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],

                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }

                        }]
                    }
                }
            });
        });
    });
</script>


	<script>
        var url = "{{url('/chart')}}";
        var New = new Array();
        var Amount = new Array();

        $(document).ready(function(){
            $.get(url, function(response){
                response.forEach(function(data){
                    New.push(data.dmon);
                    Amount.push(data.amount);
                });
                var abc = document.getElementById("canvas1").getContext('2d');
                var BChart = new Chart(abc, {
                    type: 'bar',
                    data: {

                        labels:New,
                        datasets: [{
                            label: 'Collection',
                            data: Amount,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],

                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }

                            }]
                        }
                    }
                });
            });
        });
    </script>




@endsection
