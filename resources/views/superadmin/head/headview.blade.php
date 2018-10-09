@extends('superadmin.master')

@section('title')
View Account Head
    @endsection

@section('content')

    <div id="editbodyload" class="col-md-12" style="  background:#FFFFFF; border:1px solid #999999;"
             id="bodyload">


            <div class="col-md-12" style=" margin-top:5px; margin-bottom: 5px; font-size:14px;  color:red; font-weight:bold; text-align: center;">
                <b></b>
            </div>
            <div class="col-md-12" style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
                <div class="col-md-6">
                    <b>View Account Head Information</b>
                </div>

                <div class="col-md-12" >
                    <div style="float:right; padding-right:10px">
                    <button id="btn_add" name="btn_add"  class="btn btn-info btn-xs pull-right">ADD NEW </button>
                </div>

                 </div>

    </div>

                    <section class="card">
        <div class="container">
            <!-- Important to work AJAX CSRF -->
            <meta name="_token" content="{!! csrf_token() !!}" />
            <body>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 margin-tb">
                           </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <table class="table table-striped table-hover ">
                            <thead>
                            <tr class="">
                                <th>ID </th>
                                <th>Head Name</th>
                                <th>Head Details</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="products-list" name="products-list">
                            @foreach ($products as $product)
                                <tr id="product{{$product->id}}" class="active">
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td width="35%">
                                        <button class="btn btn-warning btn-detail open_modal" value="{{$product->id}}">Edit</button>
                                        <button class="btn btn-danger btn-delete delete-product" value="{{$product->id}}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}

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
                            <h4 class="modal-title" id="myModalLabel">Head Form</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                <div class="form-group error">
                                    <label for="inputName" class="col-sm-3 control-label">Head Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name"value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDetail" class="col-sm-3 control-label">Details</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="price" name="price"value="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save Changes</button>
                            <input type="hidden" id="product_id" name="product_id" value="0">
                        </div>
                    </div>
                </div>
            </div>


            <!-- Scripts -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="{{asset('js/ajaxscript.js')}}"></script>
            </body>
        </div>
    </section>


@endsection