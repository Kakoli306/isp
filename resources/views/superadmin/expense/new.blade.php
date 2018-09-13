@extends('superadmin.master')

@section('title')
    Monthly Expense report
@endsection

@section('content')
    <section class="card">
        <div class="container">
            <!-- Important to work AJAX CSRF -->
            <meta name="_token" content="{!! csrf_token() !!}" />

            <body>

            <div class="container">

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <table class="table table-striped table-hover ">
                            <thead>
                            <tr class="info">
                                <th>#</th>
                                <th>Head name </th>
                                <th>Expense</th>
                            </tr>
                            </thead>
                            <tbody id="products-list" name="products-list">

                            <?php $all= DB::table('expenses')
                                ->join('products', 'expenses.product_id', '=', 'products.id')
                                ->select('expenses.*', 'products.name')
                                ->select('product_id')
                                ->groupBy('product_id')
                                ->get();
                              ?>


                            @foreach ($expenses as $expense)
                                <tr id="expense{{$expense->product_id}}" class="active">
                                    <td>{{ ++$i }}</td>
                                    <td>{{$expense->dates}}<td>
                                    <td>{{$expense->sums}}</td>
                                    <td>
                                        <?php

                                        $var = DB::table('expenses')->where('product_id',$expense->product_id)->sum('price') ;

                                        ?>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                           Total expense {{$total}}
                        </table>
                    </div>
                </div>
            </div>
            </body>
        </div>
    </section>

    @endsection