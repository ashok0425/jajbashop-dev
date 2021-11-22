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

@if (__getAdmin()->dashboard==1)

            <li class="sidebar-item <?php echo PAGE=='dashboard' ? 'active':'' ?>">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}" >
      <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
    </a>
            </li>

            <li class="sidebar-item <?php echo PAGE=='super' ? 'active':'' ?>">
                <a class="sidebar-link" href="{{route('admin.sale.create')}}" >
      <i class="fas fa-rupee-sign"></i> <span class="align-middle">Make Sale</span>
    </a>
            </li>
            @endif

            @if (__getAdmin()->epin==1)
          
            <li class="sidebar-item   <?php echo PAGE=='pin' ? 'active':'' ?>">
                <a data-target="#pin" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-key"></i>
       <span class="align-middle"> Manage E-pin</span>
    </a>
                <ul id="pin" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='pin'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.epin.used')}}">Used E-pin </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.epin.unused')}}">Unused E-pin </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.epin.request')}}">E-pin Request </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.epin.transfer')}}">Transfer E-pin </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.epin.transfer.history')}}">Transfer Histor </a></li>



                </ul>
            </li>
            @endif

           

            @if (__getAdmin()->user==1)

        
            <li class="sidebar-item    <?php echo PAGE=='member' ? 'active':'' ?>">
                <a data-target="#member" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-dollar-sign"></i>
       <span class="align-middle"> User Data</span>
    </a>
                <ul id="member" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='member'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.user.inactive')}}">Inactive user </a></li>
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.user.all')}}">All user </a></li>




                </ul>
            </li>
            @endif
            @if (__getAdmin()->kyc==1)

       
            <li class="sidebar-item    <?php echo PAGE=='kyc' ? 'active':'' ?>">
                <a data-target="#kyc" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-university"></i>
       <span class="align-middle"> Kyc Data</span>
    </a>
                <ul id="kyc" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='kyc'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.kyc.pending')}}">Pending Kyc</a></li>
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.kyc.approved')}}">Approved Kyc</a></li>
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.kyc.rejected')}}">Rejected Kyc</a></li>




                </ul>
            </li>
            @endif


            @if (__getAdmin()->withdrawal==1)

          
            <li class="sidebar-item    <?php echo PAGE=='withdrawal' ? 'active':'' ?>">
                <a data-target="#withdrawal" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-dollar-sign"></i>
       <span class="align-middle"> Withdrawal Data</span>
    </a>
                <ul id="withdrawal" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='withdrawal'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.user.withdrawal.pending')}}">Pending Withdrawal List </a></li>
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.user.withdrawal.approved')}}">Approved Withdrawal List </a></li>
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.user.withdrawal.rejected')}}">Rejected Withdrawal List </a></li>



                </ul>
            </li>
            @endif
            @if (__getAdmin()->deposite==1)

            <li class="sidebar-item    <?php echo PAGE=='deposite' ? 'active':'' ?>">
                <a data-target="#deposite" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-dollar-sign"></i>
       <span class="align-middle"> Deposited Data</span>
    </a>
                <ul id="deposite" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='deposite'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.user.deposite.pending')}}">Pending Withdrawal List </a></li>
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.user.deposite.approved')}}">Approved Withdrawal List </a></li>
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.user.deposite.rejected')}}">Rejected Withdrawal List </a></li>



                </ul>
            </li>
            @endif


        </ul>
        <ul class="sidebar-nav">
            <li class="sidebar-header sidebar-item font-weight-bold text-white">
               <h4 class="text-white">Repurchase</h4>
            </li>

            <li class="sidebar-item    <?php echo PAGE=='distributor' ? 'active':'' ?>">
                <a data-target="#distributor" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-users"></i>
               <span class="align-middle"> Distributor </span>
                </a>
                <ul id="distributor" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='distributor'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.distributor.pending')}}">Pending Distributor </a></li>
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.distributor')}}">Distributor List </a></li>
                </ul>
            </li>


            <li class="sidebar-item    <?php echo PAGE=='super' ? 'active':'' ?>">
                <a data-target="#super" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-users"></i>
               <span class="align-middle">Super Distributor </span>
                </a>
                <ul id="super" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='super'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.super')}}">Super  List </a></li>
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.super.create')}}">Add New </a></li>
                   


                </ul>
            </li>




            <li class="sidebar-header sidebar-item font-weight-bold text-white">
                <h4 class="text-white"> General Section</h4>
             </li>

            @if (__getAdmin()->levelprice==1)        
            <li class="sidebar-item   <?php echo PAGE=='levelprice' ? 'active':'' ?>">
                <a data-target="#levelprice" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-money-check"></i>
       <span class="align-middle"> Primary Setup</span>
    </a>
                <ul id="levelprice" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='levelprice'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.level.price')}}">Level Price </a></li>

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.repurchase.comission')}}">Repurchase Commission </a></li>

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.repurchasetopup')}}">Repurchase Topup  </a></li>


                </ul>
            </li>
            @endif

            @if (__getAdmin()->role==1)
            <li class="sidebar-item   <?php echo PAGE=='role' ? 'active':'' ?>">
             <a data-target="#role" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-user"></i>
            <span class="align-middle"> Role & Permission</span>
        </a>
             <ul id="role" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='role'?'show':'' ?>" data-parent="#sidebar" style="">

                 <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.role')}}">Role  </a></li>

             </ul>
         </li>
         @endif

         @if (__getAdmin()->profile==1)

                <li class="sidebar-item   <?php echo PAGE=='profile' ? 'active':'' ?>">
            <a data-target="#ui" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-user"></i>
        <span class="align-middle"> Profile</span>
        </a>
            <ul id="ui" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='profile'?'show':'' ?>" data-parent="#sidebar" style="">

                <li class="sidebar-item"><a class="sidebar-link"  href="{{route('admin.profile')}}">Profile </a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.changepassword')}}">Change Pasword</a></li>

                </ul>
            </li>
            @endif


            <br>
            <br>
            <br>

        </ul>
    </div>
</nav>
