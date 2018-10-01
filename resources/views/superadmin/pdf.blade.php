@extends('superadmin.master')

@section('title')
    Invoice
@endsection

@section('content')

        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
    <table class="table table-bordered">
        <tr>
            <td>
                {{$customers->month_amount}}
            </td>
            <td>
                {{$customers->bill_amount}}
            </td>
        </tr>
        <tr>
            <td>
                {{$customers->connection_charge}}
            </td>
            <td>
            </td>
        </tr>
    </table>
    </body>
    </html>

    <section class="card">
    <div class="card-body">
        <div class="invoice">
            <header class="clearfix">
                <div class="row">
                    <div class="col-sm-6 mt-3">
                        <h2 class="h2 mt-0 mb-1 text-dark font-weight-bold">INVOICE</h2>
                        <h4 class="h4 m-0 text-dark font-weight-bold">#76598345</h4>
                    </div>
                    <div class="col-sm-6 text-right mt-3 mb-3">
                        <address class="ib mr-5">
                            Okler Themes Ltd
                            <br/>
                            123 Porto Street, New York, USA
                            <br/>
                            Phone: +12 3 4567-8901
                            <br/>
                            okler@okler.net
                        </address>
                        <div class="ib">
                            <img src="img/invoice-logo.png" alt="OKLER Themes" />
                        </div>
                    </div>
                </div>
            </header>
            <div class="bill-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bill-to">
                            <p class="h5 mb-1 text-dark font-weight-semibold">To:</p>
                            <address>
                                Envato
                                <br/>
                                121 King Street, Melbourne, Australia
                                <br/>
                                Phone: +61 3 8376 6284
                                <br/>
                                info@envato.com
                            </address>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bill-data text-right">
                            <p class="mb-0">
                                <span class="text-dark">Invoice Date:</span>
                                <span class="value">05/20/2017</span>
                            </p>
                            <p class="mb-0">
                                <span class="text-dark">Due Date:</span>
                                <span class="value">06/20/2017</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-responsive-md invoice-items">
                <thead>
                <tr class="text-dark">
                    <th id="cell-id"     class="font-weight-semibold">#</th>
                    <th id="cell-desc"   class="font-weight-semibold">Description</th>
                    <th id="cell-price"  class="text-center font-weight-semibold">Month</th>
                    <th id="cell-qty"    class="text-center font-weight-semibold">Speed</th>
                    <th id="cell-total"  class="text-center font-weight-semibold">Bill Amount</th>
                </tr>
                </thead>
                <tbody>


                    <tr>
                    <td></td>
                    <td></td>

                    </tr>

                </tbody>
            </table>


             </div>

        <div class="text-right mr-4">
            <a href="#" class="btn btn-default">Submit Invoice</a>
            <a href="" target="_blank" class="btn btn-primary ml-3"><i class="fas fa-print"></i> Print</a>
        </div>
    </div>
</section>

    @endsection
<!-- end: page -->
