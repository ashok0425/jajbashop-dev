<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle d-flex">
<i class="hamburger align-self-center"></i>

</a>

          {{-- fetching all pending order  --}}


    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            @if (session()->has('mlogin') && session()->get('mlogin')==1)

            <li class="nav-itemd-block ">
                <a href="{{route('admin.user.all')}}">Back to admin</a>

           </li>
           @endif

            <li class="nav-item dropdown d-block d-md-none">
           <p>
                   {{ Auth::user()->userid }}
                        {{ Auth::user()->name }}
           </p>

                </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator">0</span>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        0 Pending shipment
                    </div>
                    <div class="list-group" style="height: 300px;overflow-y:scroll;">
                        <a href="0" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-danger" data-feather="alert-circle"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Ashok</div>
                                    <div class="text-muted small mt-1">55</div>
                                    <div class="text-muted small mt-1">20</div>
                                </div>
                            </div>
                        </a>


                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="" class="text-muted">Show all pending Shipment</a>
                    </div>
                </div>
            </li>






            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
    <i class="align-middle" data-feather="settings"></i>
  </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
    <img src="{{ asset(Auth::user()->profile_photo_path) }}" class="avatar img-fluid rounded mr-1" alt="l" />
    <span class="text-dark">{{ Auth::user()->name }}
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ Auth::user()->userid }}
    </span>
  </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('member.profile') }}"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('member.profile') }}"><i class="fas fa-cog"></i> Setting</a>
                    <a class="dropdown-item" href="{{ route('member.logout') }}"><i class="fas fa-power-off"></i> Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
