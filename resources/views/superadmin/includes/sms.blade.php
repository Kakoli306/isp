@extends('superadmin.master')

@section('title')
    Due SMS
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
                <section class="card">
                    <div class="text-left;">
                        <script>
                            function goBack() {
                                window.history.back()
                            }
                        </script>

                        <button onclick="goBack()"><i class="fas fa-arrow-left"></i> </button>

                    </div>

                    <header class="card-header">

                    </header>
                    <form action="{{url('/sms')}}" method="POST" >
                        {{csrf_field()}}

                        <h3>{{session('success')}}</h3>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-6">Sms Description <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name = "sms" class="form-control">

                            </div>
                        </div>
                                           </div>
                    <footer class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </footer>
                </section>

            </form>
        </div>


    @endsection