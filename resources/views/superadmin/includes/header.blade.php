
<!-- start: header -->
<header class="header">
    <div class="logo-container">
        @role('superadmin')
        <a href="{{url("/superadminPage")}}"
           class="logo"><img src="{{asset('superadmin/')}}/img/ab.jpg" width="75" height="35" alt="Porto Admin" /></a>
        @endrole
        @role('admin')
        <a href="{{url("/adminPage")}}"
           class="logo"><img src="{{asset('superadmin/')}}/img/ab.jpg" width="75" height="35" alt="Porto Admin" /></a>
        @endrole
        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    {{--<div class="center">--}}
        {{--<h4>Example heading <span class="badge badge-secondary">New</span></h4>--}}

    {{--</div>--}}

    <div class="header-right">

            <span class="separator"></span>

            <span class="separator"></span>

        <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture"></figure>
                    <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">

                        <a style="color: RoyalBlue;" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a><i class="fas fa-power-off"></i>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </div>
                </a>

                  </div>
        </div>
</header>


