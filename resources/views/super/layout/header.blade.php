<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle d-flex">
<i class="hamburger align-self-center"></i>
</a>
          {{-- fetching all pending order  --}}


    <div class="navbar-collapse collapse">
      @php
            $earning=DB::table('accounts')->where('user_id',__getSuper()->id)->where('user_type',3)->sum('amount');
        @endphp

    <h4 class='font-weight-bold'>
    Wallet Amount: {{__getPriceunit(). number_format($earning,2)}}
    </h4>
        <ul class="navbar-nav navbar-align">
            {{-- back to admin after login to super --}}
            @if (session()->has('slogin') && session()->get('slogin')==1)
            <li class="nav-itemd-block ">
                <a href="{{route('admin.super')}}">Back to admin</a>
            </li>
            @endif
            
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="" id="messagesDropdown" data-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="globe"></i>

                    </div>
                </a></li>

                    

                {{-- cart item  --}}
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle" id="alertsDropdown" title='view cart' href="{{ route('super.sale.order') }}">
                        <div class="position-relative">
                            <i class="align-middle" data-feather="shopping-cart"></i>
                            @php
                               $product=DB::table('orders')->where('seller',3)->where('seller_id',__getSuper()->id)->where('status',0)->get();
                            @endphp
                            <span class="indicator">{{count($product)}}</span>
                        </div>
                    </a>
                    </li>




                {{-- sales item  --}}
                {{-- <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle" href="" id="alertsDropdown" title='view bag'>
                        <div class="position-relative">
                            <i class="align-middle" data-feather="shopping-bag"></i>
                            @php
                                $sale=DB::table('sales')->join('products','sales.product_id','products.id')->where('user_id',__getSuper()->id)->where('seller',3)->select('sales.*','products.name','products.image','products.price')->get();
                            @endphp
                            <span class="indicator">{{count($sale)}}</span>
                        </div>
                    </a>
                </li> --}}




            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
    <i class="align-middle" data-feather="settings"></i>
  </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
    <img src="{{ asset(__getSuper()->profile_photo_path) }}" class="avatar img-fluid rounded mr-1" alt="Charles Hall" /> <span class="text-dark">{{ __getSuper()->name }}</span>
  </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('super.profile') }}"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('super.profile') }}"><i class="fas fa-cog"></i> Setting</a>
                    <a class="dropdown-item" href="{{ route('super.logout') }}"><i class="fas fa-power-off"></i> Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
