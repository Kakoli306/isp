@extends('superadmin.master')

@section('title')
View All Zone
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <b>View Zone Information </b>
                </div>
                <div class="col-md-4" style="font-family: Helvetica;">
                    <div class="col-md-">
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="float:right; padding-right:10px">
                        <button id="btn_add" name="btn_add"  class="btn btn-info btn-xs pull-right">ADD NEW </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom:10px;">
        <div class="col-md-4">
            <div class="btn-group" role="group">
            </div>
        </div>
        <div class="col-md-4 col-md-offset-4">
        </div>

        <div class="col-md-4 col-md-offset-4">
            <form>
                <div class="input-group">
                    <input type="search_text" name="search_text" id="search_text" class="form-control" placeholder="Search for...">
                </div>
            </form>
        </div>

    </div>



            <!-- Important to work AJAX CSRF -->
            <meta name="_token" content="{!! csrf_token() !!}" />

            <body>

                <section class="card">
                    <div class="card-body">
                        <table class="table table-bordered">

                            <thead>
                            <tr>
                                <th>ID </th>
                                <th>Zone Name</th>
                                <th>Actions</th>
                            </tr>

                            </thead>

                            <tbody id="products-list" name="products-list">
                            @foreach ($zones as $zone)
                                <tr id="zone{{$zone->id}}" class="active">
                                    <td>{{$zone->id}}</td>
                                    <td>{{$zone->zone_name}}</td>

                                    <td width="35%">
                                        <button class="btn btn-warning btn-detail open_modal" value="{{$zone->id}}">Edit</button>
                                        <button class="btn btn-danger btn-delete delete-zone" value="{{$zone->id}}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                </div>
                </section>


            <!-- Passing BASE URL to AJAX -->
            <input id="url" type="hidden" value="{{ \Request::url() }}">

            <!-- MODAL SECTION -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Zone Form</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                <div class="form-group error">
                                    <label for="inputName" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="zone_name" name="zone_name" placeholder="Zone Name" value="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save Changes</button>
                            <input type="hidden" id="zone_id" name="zone_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
            </body>

            <!-- Scripts -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="{{asset('js/zonescript.js')}}"></script>



@endsection