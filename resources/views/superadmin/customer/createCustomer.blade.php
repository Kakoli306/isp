

@extends('superadmin.master')
@section('content')

    <div class="card">
        <div class="view overlay">
        <div class="card-body">
            <h2 class="text-center text-success">{{Session::get('message')}}</h2>

            <form role="form" enctype="multipart/form-data" method="post" action="{{ route('new-customer')}}">
                    {{ csrf_field() }}
                <div class="row" style="padding:10px; font-size: 12px;">

                    <div class="col-md-6 col-md-offset-1">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" placeholder="Full Name" required>
                        </div>
                          <div class="form-group">
                            <label for="exampleInputMobile1">Mobile Number</label>
                            <input type="number" name="mobile_no" class="form-control" id="exampleInputnumber" placeholder="Mobile No" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Blood Group</label>
                            <select name="blood_group" class="form-control" style="margin-bottom: 5px;" required>
                                <option value="">Blood Group</option>
                                <option value="A+=">A Positive(A + ve)</option>
                                <option value="A-">A Negative(A - ve)</option>
                                <option value="B+">B Positive(B + ve)</option>
                                <option value="B-">B Negative(B - ve)</option>
                                <option value="AB+">AB Positive(AB + ve)</option>
                                <option value="AB-">AB Negative(AB - ve)</option>
                                <option value="O+">O Positive(O + ve)</option>
                                <option value="O-">O Negative(O - ve)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">National Id</label>
                            <input type="text" name="national_id" class="form-control" id="Inputnational_id" placeholder="National Id">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Occupation</label>
                            <input type="text" name="occupation" class="form-control" id="Inputoccupation" placeholder="Occupation" required>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <textarea class="form-control" name="address" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Zone</label><a class="btn btn-default" style="padding: 0px 6px;font-size: 12px; float:right;" href="" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus">Add Zone</i></a>
                                    <select name="zone" class="form-control" style="margin-bottom: 5px;" required>
                                        <option value="1">alltime</option>
                                        <option value="0">meaningless</option>
                                    </select>

                            </div>


                        <div class="form-group">
                            <label for="exampleInputPassword1">Month Amount</label>
                            <input type="float" name="month_amount" class="form-control" id="month_amount" placeholder="Month Amount" required>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputPassword1">Bill Amount</label>
                            <input type="float" name="bill_amount" class="form-control" id="bill_amount" placeholder="Bill Amount" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Connection Charge</label>
                            <input type="string" name="connection_charge" class="form-control" id="connection_charge" placeholder="Connection Charge">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">IP Address</label>
                            <input type="string" name="ip_address" class="form-control" id="ip_address" placeholder="IP Address" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Connection Date</label>
                            <input type="date" name="connection_date" class="form-control" id="connection_date" placeholder="Connection Date" required>
                        </div>

                        <div class="form-group">
                            <label for="speed">Speed</label>
                            <input type="string" name="speed" class="form-control" id="speed" placeholder="Speed" required>
                        </div>


                        <div class="box-body">
                            <div class="form-group">
                            <label for="exampleInputEmail1"> Status</label>
                            <select name="status" class="form-control" style="margin-bottom: 5px;" required>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>




                        <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>

                    </div>



                </div>

                </div>
            </form>
        </div>

    </div>


<!-- zone modal -->


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Zone</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <form action="" method="post">

      <div class="form-group">
          <label for="speed">Zone Name</label>
          <input type="string" name="zone" class="form-control" id="speed" placeholder="Speed" required>
      </div>

    </form>
      </div>
      <div class="modal-footer">
        <button type="button" style="float:center;" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection
