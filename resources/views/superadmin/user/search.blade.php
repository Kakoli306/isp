<?php
if(!empty($users ))
{
    $count = 1;
    $outputhead = '';
    $outputbody = '';
    $outputtail ='';

    $outputhead .= '<div class="table-responsive">
                    <table class="table table-responsive-md mb-0" id="datatable-editable">
                <thead>


                    <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>User Type</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
   ';

@foreach($users as $user)
    {
        $body = substr(strip_tags($user->body),0,50)."...";
        $outputbody .=  '


              <tr id="demo">
                        <td>'.$count++.'</td>
                        <td>'.$user->title.'</td>
                        <td> href="{{ route('user-details',['id'=>$user->userId])  }}">{{ $user->username }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{$data[0]->name}}</td>
                        <td>
                            @if($user->status == 1)
                                Active
                            @else
                                InActive
                            @endif
                        </td>

                        <td><a style="color: RoyalBlue;" href="{{url('user/edit/'.$user->userId)}}">Edit</a> </td>



                      <td><a style="color: RoyalBlue;" href="{{ route('ch') }}">Change Password</a></td>

               </tr>
              ';

                            <tr>
		                        <td>'.$count++.'</td>
		                        <td>'.$post->title.'</td>
		                        <td>'.$body.'</td>
                                <td>'.$post->created_at.'</td>
                                <td><a href="'.$show.'" target="_blank" title="SHOW" ><span class="glyphicon glyphicon-list"></span></a></td>
                            </tr>
                    ';

    }

    $outputtail .= '
                        </tbody>
                    </table>
                </div>';

    echo $outputhead;
    echo $outputbody;
    echo $outputtail;
}

else
{
    echo 'Data Not Found';
}
?>
