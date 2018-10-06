<aside id="sidebar-right" class="sidebar-right">
  <div class="nano">
    <div class="nano-content">
      <a href="#" class="mobile-close d-md-none">
        Collapse <i class="fas fa-chevron-right"></i>
      </a>

      <div class="sidebar-right-wrapper">

        <div class="sidebar-widget widget-calendar">
          <h6>Upcoming Tasks</h6>
          <div data-plugin-datepicker data-plugin-skin="dark"></div>

          <ul>
            <li>
              <time datetime=></time>
              <span>{{date('Y-m-d H:i:s')}}</span>
            </li>
          </ul>
        </div>

        @foreach($customer as $cust)

        <div class="sidebar-widget widget-friends">
          <h6>Customers</h6>
          <ul>
            <li class="status-online">
              <figure class="profile-picture">
                <img src="{{asset('superadmin/')}}/img/%21sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
              </figure>


              <div class="profile-info">
                  <span class="name">{{ $cust->customer_name }}</span>
                  <span class="mobile">{{ $cust->mobile_no }}</span>
              </div>


            </li>

          </ul>


        </div>
          @endforeach

      </div>
    </div>
  </div>
</aside>