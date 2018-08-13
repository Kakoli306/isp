<section class="body">

  <!-- start: header -->
  <header class="header">
    <div class="logo-container">
      <a href="http://preview.oklerthemes.com/porto-admin/2.1.1" class="logo"><img src="{{asset('superadmin/')}}/img/logo.png" width="75" height="35" alt="Porto Admin" />					</a>					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>					</div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

      <form action="http://preview.oklerthemes.com/porto-admin/2.1.1/pages-search-results.html" class="search nav-form">
        <div class="input-group">
          <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
          <span class="input-group-append">
            <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
          </span>
        </div>
      </form>

      <span class="separator"></span>



      <span class="separator"></span>

      <div id="userbox" class="userbox">
        <a href="#" data-toggle="dropdown">
          <figure class="profile-picture">
            <img src="{{asset('superadmin/')}}/img/%21logged-user.jpg" alt="Joseph Doe" class="rounded-circle" data-lock-picture="{{asset('superadmin/')}}/img/%21logged-user.jpg" />
          </figure>
          <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
            <span class="name">{{ Auth::user()->name }} </span>
            <span class="role">{{$role}}</span>
          </div>

          <i class="fa custom-caret"></i>
        </a>

        <div class="dropdown-menu">
          <ul class="list-unstyled mb-2">
            <li class="divider"></li>
            <li>
              <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fas fa-user"></i> My Profile</a>
            </li>
            <li>
              <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fas fa-lock"></i> Lock Screen</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- end: search & user box -->
  </header>
