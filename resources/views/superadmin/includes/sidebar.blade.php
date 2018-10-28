<div class="inner-wrapper">
    <!-- start: sidebar -->

    <aside id="sidebar-left" class="sidebar-left">

        <div class="sidebar-header">

            <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <div class="nano">
            <div class="nano-content">
                <nav id="menu" class="nav-main" role="navigation">

                    <ul class="nav nav-main">
                        <li>
                            <a class="nav-link" href="{{url("/superadminPage")}}">
                                <i class="fas fa-home" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-parent nav-expanded nav-active">
                            <a class="nav-link" href="#">
                                <i class="fas fa-columns" aria-hidden="true"></i>
                                <span>Users</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a class="nav-link" href="{{ route('create-user') }}">
                                        User Create
                                    </a>

                                    <a class="nav-link" href="{{route('user-show')}}">
                                        View User Info
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-parent nav-expanded nav-active">
                            <a class="nav-link" href="#">
                                <i class="fas fa-columns" aria-hidden="true"></i>
                                <span>Customers</span>
                            </a>

                            <ul class="nav nav-children">
                                <li>
                                    <a class="nav-link" href="{{route('add-customer') }}">
                                        Add New Customers
                                    </a>

                                    <a class="nav-link" href="{{route('manage-customer')}}">
                                        Customer Info
                                    </a>

                                    <a class="nav-link" href="{{route('yes')}}">
                                        New Customer
                                    </a>
                                    <a class="nav-link" href="{{ url("/zone") }}">
                                        View Zone Info
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-parent nav-expanded nav-active">
                            <a class="nav-link" href="#">
                                <i class="fas fa-columns" aria-hidden="true"></i>
                                <span>Income</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a class="nav-link" href="{{route('index')}}">
                                        Bill Collection
                                    </a>

                                    <a class="nav-link" href="{{route('unpaid_customer')}}">
                                        All Dues
                                    </a>

                                    <a class="nav-link" href="{{route('paid_customer')}}">
                                        All Paid Customer
                                    </a>
                                    <a class="nav-link" href="{{route('connection')}}">
                                        Connection Charge
                                    </a>
                                    <a class="nav-link" href="{{ url('income') }}">
                                        Others Income
                                    </a>
                                    <a class="nav-link" href="{{route('inc_report')}}">
                                        Income Report
                                    </a>

                                </li>

                            </ul>
                        </li>

                        <li class="nav-parent nav-expanded nav-active">
                            <a class="nav-link" href="#">
                                <i class="fas fa-columns" aria-hidden="true"></i>
                                <span>Expense</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a class="nav-link" href="{{ url('/product') }}">
                                        Account Head
                                    </a>

                                    <a class="nav-link" href="{{route('discount')}}">
                                        Discount
                                    </a>

                                    <a class="nav-link" href="{{ url('expenses') }}">
                                        Expense
                                    </a>
                                    <a class="nav-link" href="{{route('expense_report')}}">
                                        Expense Report
                                    </a>
                                    <a class="nav-link" href="{{route('statement')}}">
                                        Account Statement
                                    </a>

                                </li>

                            </ul>
                        </li>

                        <li class="nav-parent nav-expanded nav-active">
                            <a class="nav-link" href="#">
                                <i class="fas fa-columns" aria-hidden="true"></i>
                                <span>Balance Sheet</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a class="nav-link" href="{{route('monthly')}}">
                                        Monthly Balance Report
                                    </a>

                                    <a class="nav-link" href="{{route('yearly')}}">
                                        Yearly Balance Report
                                    </a>

                                    <a class="nav-link" href={{url('/importExport')}}>
                                        Export in Excel file
                                    </a>

                                </li>

                            </ul>
                        </li>

                        <li class="nav-parent nav-expanded nav-active">
                            <a class="nav-link" href="#">
                                <i class="fas fa-columns" aria-hidden="true"></i>
                                <span>SMS Report</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a class="nav-link" href="{{ url('/smspage') }}">
                                        Due SMS
                                    </a>

                                    <a class="nav-link" href="#">
                                        Occational SMS
                                    </a>

                                </li>

                            </ul>
                        </li>

                        <script>
                            // Maintain Scroll Position
                            if (typeof localStorage !== 'undefined') {
                                if (localStorage.getItem('sidebar-left-position') !== null) {
                                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                                    sidebarLeft.scrollTop = initialPosition;
                                }
                            }
                        </script>

                    </ul>
                </nav>
            </div>
        </div>
    </aside>
    <!-- end: sidebar -->



            <section role="main" class="content-body">

                <header class="page-header">
                    <h2></h2>
                    <h2></h2>
                    <h2></h2>
                    <h2></h2>
                    <h2></h2>
                    <h2></h2>
                    <h2></h2>
                    <h2></h2>
                    <h2></h2>
                    <h2></h2>
                    <h2></h2>
                    <h2></h2>
                    <h2 id="currentTime"</h2>

                    <head>

                    <style>
                        @import url(https://fonts.googleapis.com/css?family=Oswald:300,400);
                        body {
                        }
                        #currentTime {
                            text-align: center;
                            color: #f05b19;
                            margin: 100px auto;
                        }
                    </style>
                    <script>
                        window.onload = function() {
                            clock();
                            function clock() {
                                var now = new Date();
                                var TwentyFourHour = now.getHours();
                                var hour = now.getHours();
                                var min = now.getMinutes();
                                var mid = 'pm';
                                if (min < 10) {
                                    min = "0" + min;
                                }
                                if (hour > 12) {
                                    hour = hour - 12;
                                }
                                if(hour==0){
                                    hour=12;
                                }
                                if(TwentyFourHour < 12) {
                                    mid = 'am';
                                }
                                document.getElementById('currentTime').innerHTML = hour+':'+min +' '+ mid ;
                                setTimeout(clock, 1000);
                            }
                        }

                    </script>
                </head>
                    </body>
            </h2>



            <div class="right-wrapper text-right">
                <ol class="breadcrumbs">

                    <li><span>Welcome</span></li>
                  <body>  <span class="name"> {{ Auth::user()->username }}</span></body>
                </ol>

                      </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>


        <!-- start: page -->