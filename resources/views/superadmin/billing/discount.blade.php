@extends('superadmin.master')

@section('title')
    Discount
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 "
             style=" background:#606060; margin-top:20px; margin-bottom: 15px; min-height:45px; padding:8px 0px 0px 15px; font-size:16px; font-family:Lucida Sans Unicode; color:#FFFFFF; font-weight:bold;">
            <div class="row">
                <div class="col-md-4">
                    <b>View Discount Information</b>
                </div>

            </div>
        </div>
    </div>

    <section class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <div class="text-left;">
                        <script>
                            function goBack() {
                                window.history.back()
                            }
                        </script>

                        <button onclick="goBack()"><i class="fas fa-arrow-left"></i> </button>

                    </div>

                    <div class="summary">

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


            <div class="card-body">
                <div class="row">

                    <table class="table table-bordered">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Taken By</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($customers as $billing)
                            <tr>
                                <td>{{  ++$i  }}</td>
                                <td>{{ Carbon\Carbon::parse($billing->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $billing->customer_name }}</td>
                                <td>{{ $billing->payment_amount }}</td>
                                <td><a style="color: RoyalBlue;" href="{{ route('user-details',['id'=>$users->userId])  }}"> {{ $users->username }}</td></a>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <div class="pull-right">{{ $customers->links() }}</div>

                </div>
            </div>
        </div>
    </section>



    <!-- end: page -->
@endsection
