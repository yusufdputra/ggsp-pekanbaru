<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{'/'}}" class="logo"><img src="{{asset('adminto/images/brand/logo2.png')}}" height="40px" alt=""><i class="mdi mdi-layers"></i></a>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">

            <!-- Page title -->
            <ul class="nav navbar-nav list-inline navbar-left">
                <li class="list-inline-item">
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
                <li class="list-inline-item">
                    <h4 class="page-title">{{$title}}</h4>
                </li>
            </ul>

        </div><!-- end container -->
    </div><!-- end navbar -->
</div>
<!-- Top Bar End -->