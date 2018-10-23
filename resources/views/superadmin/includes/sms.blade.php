@extends('superadmin.master')

@section('title')
    Due SMS
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
                <section class="card">
                    <header class="card-header">

                    </header>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-6">Sms Description <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text">

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