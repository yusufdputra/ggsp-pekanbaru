<div class="left side-menu ">
  <div class="sidebar-inner slimscrollleft">

    <!-- User -->
    <div class="user-box">
      <div class="user-img">
        <img src="{{asset('adminto/images/users/avatar-1.jpg')}}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
        <div class="user-status online"><i class="mdi mdi-adjust"></i></div>
      </div>
      <h5><a href="#"> {{ Auth::user()->username }}</a> </h5>
      <ul class="list-inline">


        <li class="list-inline-item">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </div>
    <!-- End User -->

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <ul>
        <li class="text-muted menu-title">Navigation</li>
        <li>
          <a href="{{('/')}}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
        </li>
        @role('admin')


        <li class="has_sub">
          <a href="javascript:void(0);" class="waves-effect"><i class=" mdi mdi-account-multiple"></i> <span> Data User </span> <span class="fa menu-arrow"></span></a>
          <ul class=" list-unstyled">
            <li><a href="{{route ('sales.index', 'Sales')}}">Sales</a></li>
            <li><a href="{{route ('agen.index')}}">Outlet</a></li>
          </ul>
        </li>

        <li>
          <a href="{{route ('barang.index')}}" class="waves-effect"><i class="mdi mdi-cube"></i> <span> Data Barang </span> </a>
        </li>

        <li>
          <a href="{{route ('peringkat.index')}}" class="waves-effect"><i class="mdi mdi-star-circle"></i> <span> Peringkat </span> </a>
        </li>

        <li>
          <a href="{{route ('kehadiran.index')}}" class="waves-effect"><i class="mdi mdi-calendar-check"></i> <span> Kehadiran </span> </a>
        </li>

        @endrole

        @role("sales")

        <li>
          <a href="{{route ('entri.index')}}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span> Entri Outlet </span> </a>
        </li>

        <li>
          <a href="{{route ('kehadiran.index')}}" class="waves-effect"><i class="mdi mdi-calendar-check"></i> <span> Kehadiran </span> </a>
        </li>

        @endrole

        @role("agen")

        <li>
          <a href="{{route ('pembelian.index')}}" class="waves-effect"><i class="mdi mdi-cart"></i> <span> Pembelian </span> </a>
        </li>
        <li>
          <a href="{{route ('peringkat.index')}}" class="waves-effect"><i class="mdi mdi-star-circle"></i> <span> Peringkat </span> </a>
        </li>

        @endrole





      </ul>
      <div class="clearfix"></div>
    </div>
    <!-- Sidebar -->
    <div class="clearfix"></div>

  </div>

</div>
<!-- Left Sidebar End -->



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">


    </div> <!-- container -->

  </div> <!-- content -->

  <footer class="footer text-right">
    2021 - GGSP COMPETITION PEKANBARU
  </footer>

</div>