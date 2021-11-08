<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle d-flex">
<i class="hamburger align-self-center"></i>
</a>
          {{-- fetching all pending order  --}}


    <div class="navbar-collapse collapse">
      @php
            $earning=DB::table('accounts')->where('user_id',__getDist()->id)->where('user_type',3)->sum('amount');
        @endphp

    <h4 class='font-weight-bold'>
    Wallet Amount: {{__getPriceunit().number_format( $earning,2)}}
    </h4>
        <ul class="navbar-nav navbar-align">
             {{-- back to admin after login to Distributor login --}}
             @if (session()->has('dlogin') && session()->get('dlogin')==1)
             <li class="nav-itemd-block ">
                 <a href="{{route('admin.distributor')}}">Back to admin</a>
             </li>
             @endif
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="" id="messagesDropdown" data-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="globe"></i>

                    </div>
                </a></li>


            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
    <i class="align-middle" data-feather="settings"></i>
  </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
    <img src="{{ asset(__getDist()->profile_photo_path) }}" class="avatar img-fluid rounded mr-1" alt="" /> <span class="text-dark">{{ __getDist()->name }}</span>
  </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('distributor.profile') }}"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('distributor.profile') }}"><i class="fas fa-cog"></i> Setting</a>
                    <a class="dropdown-item" href="{{ route('distributor.logout') }}"><i class="fas fa-power-off"></i> Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
