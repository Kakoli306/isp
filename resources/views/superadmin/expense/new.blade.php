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
                                <th>Head name </th>
                                <th>Expense</th>

                            </tr>
                            </thead>
                            <tbody id="products-list" name="products-list">
                            @foreach ($expenses as $expense)
                                <tr id="expense{{$expense->id}}" class="active">
                                    <td>{{$expense->name}}</td>
                                    <td>{{$expense->price}}</td>
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