@extends('superadmin.master')

@section('title')
    User Info
@endsection

@section('content')

    <section class="card">
        <div class="container">

            <header class="card-header">

                <h2 class="card-title">View User Information</h2>
            </header>
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
            </div>
        </div>
    </section>
    <!-- end: page -->
    @endsection
