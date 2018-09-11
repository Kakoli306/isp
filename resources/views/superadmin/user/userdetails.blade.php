@extends('superadmin.master')

@section('title')
    User Details
@endsection

@section('content')

    <section role="main" class="content-body">
        <header class="page-header">

            <input type="hidden"  name="user_id" value="{{$userId->id}}">

            <h2>User Profile</h2>

            <div class="right-wrapper text-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="index.html">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li><span>Pages</span></li>
                    <li><span>User Profile</span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>

        <!-- start: page -->

        <div class="row">
            <div class="col-lg-4 col-xl-3 mb-4 mb-xl-0">

                   </div>
            <div class="col-lg-8 col-xl-6">

                <div class="tabs">
                    <ul class="nav nav-tabs tabs-primary">

                    </ul>
                </div>
                <div id="edit" class="tab-pane">

                    <form class="p-3">
                        <h4 class="mb-3">Personal Information</h4>
                        <div class="form-group">
                            <label for>User Status: {{$userId->status}}  </label>


                        </div>
                        <div class="form-group">
                            <label>User Type : {{$userId->status}}</label>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label >Email {{$userId->email}}</label>

                            </div>
                            <div class="form-group col-md-4">
                                <label >Permission Profile : </label>
                            </div>

                        </div>

                        <hr class="dotted tall">

                        <h4 class="mb-3">Click For More Details..</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Mobile NO : {{$userId->phone}}</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address :{{$userId->address}} </label>
                            </div>
                            </div>

                        <h4 class="mb-3">Entry By :
                        </h4>
                        <div class="form-group col-md-6">
                            <label>Entry Date   : {{$userId->created_at}} </label>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Update Date : {{$userId->updated_at}} </label>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection