<aside id="sidebar-right" class="sidebar-right">
  <div class="nano">
    <div class="nano-content">
      <a href="#" class="mobile-close d-md-none">
        Collapse <i class="fas fa-chevron-right"></i>
      </a>

      <div class="sidebar-right-wrapper">

        <div class="sidebar-widget widget-calendar">
          <div data-plugin-datepicker data-plugin-skin="dark"></div>

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

        </body>
      </div>

      </div>
  </div>
</aside>