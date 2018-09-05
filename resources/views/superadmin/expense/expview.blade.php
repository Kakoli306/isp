@extends('superadmin.master')

@section('title')
View All Expense Information
@endsection

@section('content')
<section class="card">
    <div class="container">
        <!-- Important to work AJAX CSRF -->
        <meta name="_token" content="{!! csrf_token() !!}" />

        <body>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <button id="btn_add" name="btn_add" class="btn btn-default pull-right">Add New Expense</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <table class="table table-striped table-hover ">
                        <thead>
                        <tr class="info">
                            <th>ID </th>
                            <th>Date</th>
                            <th>Head</th>
                            <th>Description</th>
                            <th>Expense Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list" name="products-list">
                        @foreach ($expenses as $expense)
                        <tr id="expense{{$expense->id}}" class="active">
                            <td>{{$expense->id}}</td>
                            <td>{{$expense->created_at}}</td>
                            <td>{{$expense->name}}</td>
                            <td>{{$expense->name}}</td>
                            <td>{{$expense->price}}</td>
                            <td width="35%">
                                <button class="btn btn-warning btn-detail open_modal" value="{{$expense->id}}">Edit</button>
                                <button class="btn btn-danger btn-delete delete-expense" value="{{$expense->id}}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Passing BASE URL to AJAX -->
        <input id="url" type="hidden" value="{{ \Request::url() }}">

        <!-- MODAL SECTION -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Expense Form</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{url('exp')}}">
                            {{csrf_field()}}
                            <div class="form-group error">
                                <label for="inputName" class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control has-error" id="name" name="name" placeholder="Description" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDetail" class="col-sm-3 control-label">Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Amount" value="">
                                </div>
                            </div>
                            <div class="orm-group">
                                <input type="hidden" id="expense_id" name="expense_id" value="0">
                                <button type="submit" data-dismiss="modal" class="btn btn-primary" id="btn-save" value="add">Save Changes</button>

                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        </body>

        <!-- Scripts -->
  <script src="{{asset('js/expensescript.js')}}"></script>
        </html>
    </div>
</section>

        @endsection