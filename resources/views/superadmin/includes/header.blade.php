<!-- start: header -->
<header class="header">

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
      </a>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
         </div>
    </div>
  <!-- end: search & user box -->
</header>
