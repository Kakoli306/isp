@extends('superadmin.master')

@section('title')
    Create Customer
    @endsection

@section('sidebar')
    <aside id="sidebar-right" class="sidebar-right">
        <div class="nano">

            <div class="nano-content">
                <a href="#" class="mobile-close d-md-none">
                    Collapse <i class="fas fa-chevron-right"></i>
                </a>

                <div class="sidebar-widget widget-calendar">

                    <div data-plugin-datepicker data-plugin-skin="dark"></div>
                    <div id="datepicker11"></div>
                    <ul>
                        <li>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search Customer...">

                        </li>
                    </ul>
                    <ul>
                    </ul>
                </div>

                <h6>Customers</h6>

                <div class="row" style="height:350px; overflow:auto;">


                    <div class="column-12" style="background-color:#180c22; ">

                        <table class="table table-bordered">

                            <thead>
                            <tr>
                                <th>Customer Name</th>
<th>Customer Status</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            </table>

                        {{--<ul id ="aside2">--}}
                            {{--@foreach($cust as $customer)--}}

                                {{--<li class="status-online">--}}
                                    {{--<figure class="profile-picture">--}}
                                        {{--<img src="{{asset('superadmin/')}}/img/%21sample-user.jpg" alt="Joseph Doe" class="rounded-circle">--}}
                                    {{--</figure>--}}

                                    {{--<div class="profile-info">--}}
                                        {{--<span class="name">{{ $customer->customer_name }}</span>--}}
                                        {{--<p>{{ $customer->mobile_no }}</p>--}}
                                        {{--@endforeach--}}

                                    {{--</div>--}}
                                {{--</li>--}}
                        {{--</ul>--}}
                    </div>


                    {{--<div class="column-6" style="background-color:#180c22; ">--}}
                        {{--<ul>--}}
                            {{--@foreach($cust1 as $customer)--}}

                                {{--<li class="status-online">--}}
                                    {{--<figure class="profile-picture">--}}
                                        {{--<img src="{{asset('superadmin/')}}/img/%21sample-user.jpg" alt="Joseph Doe" class="rounded-circle">--}}
                                    {{--</figure>--}}

                                    {{--<div class="profile-info">--}}
                                        {{--<span>{{ $customer->customer_name }}</span>--}}
                                        {{--<p>{{ $customer->mobile_no }}</p>--}}

                                        {{--@endforeach--}}

                                    {{--</div>--}}
                                {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                </div>

                <script>
                    var Start = {
                        /**
                         * @desc : switch direction
                         */
                        dir:'right',
                        /**
                         * @func : initilize
                         * @param : year
                         * @param : month
                         */
                        init:function(year, month){
                            month -= 1;
                            var dayCount = [31, (this.isLeap(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
                                date = new Date(year, month, 1),
                                currentDay = date.getDay(),
                                indentCell = 0,
                                allCell = 43,
                                dayStart = 0;
                            for(var i = 0; i < 7; i++){
                                dayStart == 7 && (dayStart = 0);
                                dayStart == currentDay && (indentCell = i);
                                dayStart++;
                            }
                            var validCell = indentCell + dayCount[month];

                            this.createFrame(year, month, validCell, indentCell, allCell);
                            this.selectDay();
                        },
                        /**
                         * @func : Skeleton
                         * @param : year
                         * @param : month
                         * @param : validCell
                         * @param : indentCell
                         * @param : allCell
                         */
                        createFrame:function(year, month, validCell, indentCell, allCell){
                            var tbody = '<tr class="ui-animated ui-animated-'+this.dir+'">',
                                thead = '<thead><tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wen</th><th>Thu</th><th>Fri</th><th>Sat</th></tr></thead>',
                                today = this.isToday(year, month),
                                that = this,
                                createDay = function(i){
                                    var current = today == (i - indentCell) ? ' z-c' : '';
                                    tbody = tbody + '<td class="td-day'+current+'">' + that.formatNum((i - indentCell)) + '</td>';
                                },
                                otherDay = function(i){
                                    var type = i > validCell ? 'td-back' : 'td-front';
                                    tbody += '<td class="'+type+'"></td>';
                                }
                            for(var i = 1; i < allCell; i++){
                                (i>1 && ((i-1) % 7 == 0)) && (tbody += '<tr class="ui-animated ui-animated-'+this.dir+'">');
                                (i>indentCell && i<=validCell) ? createDay(i) : otherDay(i);
                                (i % 7 == 0) && (tbody += '</tr>');
                            }
                            $('.u-start-body').html(thead+'<tbody>'+tbody+'</tbody>');
                            this.fillDay();
                        },
                        /**
                         * @func : filling date
                         */
                        fillDay:function(){
                            var backIndex = 1,
                                frontCnt = $('.u-start-body td.td-front').size()-1,
                                first = $('.u-start-year').text()+'/'+$('.u-start-month').text()+'/01',
                                lastDay = this.formatDate(new Date(first).getTime()-86400000, 'date'),
                                frontIndex = lastDay - frontCnt,
                                that = this;
                            $('.u-start-body td.td-back').each(function(){
                                $(this).text(that.formatNum(backIndex));
                                backIndex += 1;
                            });
                            $('.u-start-body td.td-front').each(function(){
                                $(this).text(that.formatNum(frontIndex));
                                frontIndex += 1;
                            });
                        },
                        /**
                         * @func : clicking then selecting a day
                         */
                        selectDay:function(){
                            var that = this,
                                date = null;
                            $('.u-start-body').undelegate().delegate('td.td-day', 'click', function(){
                                $(this).addClass('z-c').siblings().removeClass('z-c').parent().siblings().children().removeClass('z-c');
                                date = $('.u-start-year').text()+'-'+$('.u-start-month').text()+'-'+$(this).text();
                                that.getData(date);
                            });
                        },
                        /**
                         * @func : format digit
                         */
                        formatNum:function(num){
                            num = num.toString();
                            num.length == 1 && (num = '0'+num);
                            return num;
                        },
                        /**
                         * @func : format time stamp
                         * @param : date
                         * @param : type:retune type
                         */
                        formatDate:function(time, type){
                            var date = new Date(time),
                                year = date.getYear(),
                                month = date.getMonth()+1,
                                date = date.getDate();
                            switch(type){
                                case 'year':
                                    return year;
                                    break;
                                case 'month':
                                    return month;
                                    break;
                                case 'date':
                                    return date;
                                    break;
                                default:
                                    return year+'-'+month+'-'+date;
                            }
                        },
                        /**
                         * @func : return Today's date
                         */
                        today:function(){
                            var date = new Date();
                            return [date.getFullYear(), date.getMonth(), date.getDate()];
                        },
                        /**
                         * @func : is it leap?
                         */
                        isLeap:function(year){
                            return (year % 4) == 0 ? true : false;
                        },
                        /**
                         * @func : is today?
                         */
                        isToday:function(year, month){
                            var date = this.today();
                            return (date[0] == year && date[1] == month) ? date[2] : false;
                        },
                        /**
                         * @func : change value by selecting month
                         * @param : year:
                         * @param : month:
                         * @param : callback:
                         */
                        initDate:function(year, month, callback){
                            month = this.formatNum(month);
                            $('.u-start-month').text(month);
                            $('.u-start-year').text(year);
                            callback && callback.call(this);
                        },
                        /**
                         * @func : next month
                         */
                        nextMonth:function(){
                            var month = $('.u-start-month').text(),
                                year = $('.u-start-year').text();
                            if(month < 12){
                                ++month;
                            }
                            else{
                                month = '01';
                                ++year;
                            }
                            this.initDate(year, month, $.proxy(function(){
                                this.dir = 'right';
                                this.init(year, month);
                            }, this));
                        },
                        /**
                         * @func : last month
                         */
                        prevMonth:function(){
                            var month = $('.u-start-month').text(),
                                year = $('.u-start-year').text();
                            if(month <= 1){
                                month = 12;
                                --year;
                            }
                            else{
                                --month;
                            }
                            this.initDate(year, month, $.proxy(function(){
                                this.dir = 'left';
                                this.init(year, month);
                            }, this));
                        },
                        /**
                         * @func : ajax requre data
                         * @param : date
                         */
                        getData:function(date){
                            $('.u-start-footer').text(date);
                        }
                    }
                    var d = new Date();
                    var currentYear = d.getFullYear();
                    var currentMonth = d.getMonth()+1;
                    document.getElementsByClassName('u-start-year').item(0).innerHTML=currentYear;
                    document.getElementsByClassName('u-start-month').item(0).innerHTML=currentMonth;
                    Start.init(currentYear, currentMonth);

                    $('document').ready(function(){
                        $('.u-start-prev').on('click',function(){

                            Start.prevMonth();

                        });
                        $('.u-start-next').on('click',function(){

                            Start.nextMonth();

                        });

                    });
                </script>



                </body>
            </div>

        </div>
        </div>
    </aside>
    @endsection
@section('content')


    <div class="card">
        <div class="view overlay">

            <div class="pull-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Zone Add
                </button>
            </div>

            <div class="card-body">
                <div class="text-left;">
                    <script>
                        function goBack() {
                            window.history.back()
                        }
                    </script>

                    <button onclick="goBack()"><i class="fas fa-arrow-left"></i> </button>

                </div>

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
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Blood Group</label>
                            <select name="blood_group" class="form-control" style="margin-bottom: 5px;">
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
                            <input type="text" name="occupation" class="form-control" id="Inputoccupation" placeholder="Occupation">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <textarea class="form-control" name="address" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Zone Select</label>

                            <select id="zone_id" type="zone_id" class="form-control"
                                    name="zone_id" required>

                            @foreach ($zone as $value)
                                            <option value="{{$value->id}}" > {{$value->zone_name}}</option>
                                @endforeach
                                    </select>
                               </div>


                        <div class="form-group">
                            <label for="exampleInputPassword1">Month Amount</label>
                            <input type="float" name="month_amount" class="form-control" id="month_amount" placeholder="Month Amount">
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
                            <input type="string" name="speed" class="form-control" id="speed" placeholder="Speed">
                        </div>


                        <div class="box-body">
                            <div class="form-group">
                            <label for="exampleInputEmail1"> Status</label>
                            <select name="status" class="form-control" style="margin-bottom: 5px;" required>
                                <option value= >--Select--</option>
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
      <!--  <div id="create" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group row add">
                                <label class="control-label col-sm-2" for="zone_name">Zone :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="zone_name" name="zone_name"
                                           placeholder="Your Title Here" required>
                                    <p class="error text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="submit" id="add">
                            <span class="glyphicon glyphicon-plus"></span>Save Post
                        </button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remobe"></span>Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->



        <!-- MODAL SECTION -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Zone Form</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" enctype="multipart/form-data" method="post" action="{{ url('zoneStore')}}">
                            {{ csrf_field() }}

                            <div class="form-group error">
                                <label for="inputName" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control has-error" id="zone_name" name="zone_name" placeholder="Zone Name" value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button class="btn btn-warning" type="submit" id="btn-save">
                                <span class="glyphicon glyphicon-plus"></span>Insert Zone
                            </button>
                            </div>
                            {{--<input type="submit" class="btn btn-primary" id="btn-save" value="add">--}}

                        </form>

                    </div>

                </div>
            </div>
        </div>
</div>

    <script>
        $(document).ready(function(){
alert('hi');
            fetch_paid_data();

            function fetch_paid_data(query = '')
            {
                $.ajax({
                    url:"{{ route('aside') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);

                    }
                })
            }

            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                fetch_paid_data(query);
            });

        });
    </script>


@endsection
