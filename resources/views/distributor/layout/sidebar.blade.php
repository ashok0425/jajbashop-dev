<nav id="sidebar" class="sidebar" style="overflow:visible">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="https://jajbashop.in/">
  <span class="align-middle">
      <img src="{{asset('logo.png')}}" class="img-fluid" width="80"/>
     <p>
        <small>
          JAJBASHOP PVT LTD
      </small>
     </p>
  </span>
</a>

        <ul class="sidebar-nav">


            <li class="sidebar-item <?php echo PAGE=='dashboard' ? 'active':'' ?>">
                <a class="sidebar-link" href="{{ route('distributor.dashboard') }}" >
      <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
    </a>
            </li>


            {{-- sales --}}
            <li class="sidebar-item   <?php echo PAGE=='sales' ? 'active':'' ?>">
                <a data-target="#inventory" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-dollar-sign"></i>
       <span class="align-middle">Make Bill </span>
    </a>
                <ul id="inventory" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='sales'?'show':'' ?>" data-parent="#sidebar" style="">
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('distributor.sale.create')}}">Bill  </a></li>
                </ul>
            </li>
                {{-- Inventory  --}}
        <li class="sidebar-item <?php echo PAGE=='inventory' ? 'active':'' ?>">
            <a class="sidebar-link" href="{{ route('distributor.inventory') }}" >
        <i class="fas fa-layer-group"></i> <span class="align-middle">Inventory Data</span>
        </a>
        </li>



            {{-- <li class="sidebar-item   <?php echo PAGE=='purchase' ? 'active':'' ?>">
                <a data-target="#purchase" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-tags"></i>
       <span class="align-middle"> Manage Purchase</span>
    </a>
                <ul id="purchase" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='purchase'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('distributor.purchase.create')}}">Make purchase </a></li>


                </ul>
            </li> --}}

            <li class="sidebar-item   <?php echo PAGE=='profile' ? 'active':'' ?>">
                <a data-target="#ui" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-user"></i>
       <span class="align-middle"> Profile</span>
    </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='profile'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('distributor.profile')}}">Profile </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('distributor.changepassword')}}">Change Pasword</a></li>
                </ul>
            </li>

    

            <li class="sidebar-item   <?php echo PAGE=='report' ? 'active':'' ?>">
                <a data-target="#report" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-copy"></i>
       <span class="align-middle"> Report</span>
    </a>
                <ul id="report" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='report'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('distributor.buy.report')}}">Purchase Report </a></li>

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('distributor.sale.report')}}">Sales Report </a></li>

                </ul>
            </li>

            <br>
            <br>
            <br>

        </ul>
    </div>
</nav>
