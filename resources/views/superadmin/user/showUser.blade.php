@extends('superadmin.master')

@section('title')
    User Info
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <b>View All User Information</b>
                </div>

            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="summary">
                </div>


                <div class="col-sm-6">
                    <div class="pull-right">

                    </div>
                </div>

                <div class="col-md-3" style="">
                    <form>
                        <div class="input-group">
                            <input type="search_text" name="search_text" id="search_text" class="form-control" placeholder="Search for...">
                        </div>
                    </form>
                </div>


                <!-- start: page -->
    <section class="card">
        <div class="card-body">
            <table class="table table-responsive-lg table-bordered table-striped table-sm mb-0">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>User Type</th>
                    <th>Status</th>
                    <th>Details</th>
                    <th>Edit</th>
                    <th>Chage Pass</th>
                </tr>
                </thead>
                <tbody>



                @foreach($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            Superadmin
                        </td>
                        <td>
                            @if($user->status == 1)
                                Active
                            @else
                                InActive
                            @endif
                        </td>

                        <td><a style="color: RoyalBlue;" href="{{ route('user-details',['id'=>$user->userId])  }}">User details</a></td>


                        <td><a style="color: RoyalBlue;" href="{{url('user/edit/'.$user->userId)}}">Edit</a> </td>

                        <td><a style="color: RoyalBlue;" href="{{ route('ch') }}">Change Password</a></td>

                    <!--<td><form action="{{ route('delete-user') }}" method="POST">
                                @csrf
                            <input type="hidden" value="{{$user->userId}}" name="userId">
                                <button type="submit" onclick="return confirm('Are u sure to delete this !!!')"
                                        class="on-default remove-row"><i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                            </td> -->


                    </tr>
                </tbody>
                @endforeach
            </table>
            {{ $users->links() }}

        </div>
        <script type="text/javascript">

            var url = "{{ route('autocomplete.ajax') }}";

            $('#search_text').typeahead({

                source:  function (query, process) {

                    return $.get(url, { query: query }, function (data) {

                        return process(data);

                    });

                }

            });

        </script>


    </section>
    @endsection
