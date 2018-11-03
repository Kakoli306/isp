<aside id="sidebar-right" class="sidebar-right">
  <div class="nano">

    <div class="nano-content">
      <a href="#" class="mobile-close d-md-none">
        Collapse <i class="fas fa-chevron-right"></i>
      </a>

      {{--<div class="u-start">--}}
        {{--<div class="u-start-header">--}}
          {{--<div class="u-start-prev"><<</div>--}}
          {{--<div class="u-start-date">--}}
            {{--<strong>Start Calander</strong>--}}
            {{--<span><em class="u-start-year"></em>-<em class="u-start-month"></em></span>--}}
          {{--</div>--}}
          {{--<div class="u-start-next">>></div>--}}
        {{--</div>--}}
        {{--<table class="u-start-body"></table>--}}
        {{--<div class="u-start-footer"></div>--}}
      {{--</div>--}}
      {{--<div class="sidebar-right-wrapper">--}}

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

        <div class="row" style="height:350px; Serif;overflow:auto;">


          <div class="column-6" style="background-color:#180c22; ">

            <ul>
              @foreach($cust as $customer)

                <li class="status-online">
                  <figure class="profile-picture">
                    <img src="{{asset('superadmin/')}}/img/%21sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                  </figure>

                  <div class="profile-info">
                    <span class="name">{{ $customer->customer_name }}</span>
                    <p>{{ $customer->mobile_no }}</p>
                    @endforeach

                  </div>
                </li>
            </ul>
          </div>


          <div class="column-6" style="background-color:#180c22; ">
            <ul>
              @foreach($cust1 as $customer)

                <li class="status-online">
                  <figure class="profile-picture">
                    <img src="{{asset('superadmin/')}}/img/%21sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
                  </figure>

                  <div class="profile-info">
                    <span>{{ $customer->customer_name }}</span>
                    <p>{{ $customer->mobile_no }}</p>

                    @endforeach

                  </div>
                </li>
            </ul>
          </div>
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

        {{--<script>--}}
            {{--$(document).ready(function(){--}}

                {{--fetch_paid_data();--}}

                {{--function fetch_paid_data(query = '')--}}
                {{--{--}}
                    {{--$.ajax({--}}
                        {{--url:"{{ route('aside') }}",--}}
                        {{--method:'GET',--}}
                        {{--data:{query:query},--}}
                        {{--dataType:'json',--}}
                        {{--success:function(data)--}}
                        {{--{--}}
                            {{--$('tbody').html(data.table_data);--}}
                        {{--}--}}
                    {{--})--}}
                {{--}--}}

                {{--$(document).on('keyup', '#search', function(){--}}
                    {{--var query = $(this).val();--}}
                    {{--fetch_paid_data(query);--}}
                {{--});--}}

            {{--});--}}
        {{--</script>--}}


        </body>
      </div>

    </div>
  </div>
</aside>