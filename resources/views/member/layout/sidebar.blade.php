<nav id="sidebar" class="sidebar" style="overflow:visible">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="https://jajbashop.in/">
  <span class="align-middle">
      <img src="{{asset('logo.png')}}" class="img-fluid" width="80"/>
     <p>
        <small>
          JAJBASHOP
      </small>
     </p>
  </span>
</a>

        <ul class="sidebar-nav">


            <li class="sidebar-item <?php echo PAGE=='dashboard'?'active':'' ?>">
                <a class="sidebar-link" href="{{ route('member.dashboard') }}" >
      <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
    </a>
            </li>


            <li class="sidebar-item <?php echo PAGE=='register'?'active':'' ?>">
                <a class="sidebar-link" href="{{ route('member.register') }}" >
      <i class="fas fa-envelope"></i> <span class="align-middle">Register User</span>
    </a>
            </li>

       

            <li class="sidebar-item   <?php echo PAGE=='profile'?'pin':'' ?>">
                <a data-target="#profile" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-user"></i>
       <span class="align-middle"> Profile</span>
    </a>
                <ul id="profile" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='profile'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('member.profile')}}">Profile </a></li>
                    <li class="sidebar-item"><a class="sidebar-link"  href="{{route('member.kyc')}}">Bank/Kyc </a></li>
                 
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.changepassword')}}">Change Pasword</a></li>

                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.level.reward.voucher')}}">Level Reward Voucher</a></li>



                </ul>
            </li>

            @if (Auth::user()->status!=null)
           <li class="sidebar-item   <?php echo PAGE=='pin'?'active':'' ?>">
                <a data-target="#ui" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-key"></i>
       <span class="align-middle"> Manage E-pin</span>
    </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='pin'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.epin.used')}}">Used E-pin </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.epin.unused')}}">Unused E-pin </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.epin.request')}}"> Request E-pin </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.epin.transfer')}}">Transfer E-pin </a></li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('member.epin.transferhistory')}}">Transfer History </a></li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('member.epin.recivehistory')}}">Received History </a></li>



                </ul>
            </li>

            <li class="sidebar-item   <?php echo PAGE=='member'?'active':'' ?>">
                <a data-target="#member" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-male"></i>
       <span class="align-middle"> Manage Member</span>
    </a>
                <ul id="member" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='member'?'show':'' ?>" data-parent="#sidebar" style="">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.inactive')}}">Inactive Member</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.all')}}">All Member</a></li>

                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.level')}}">Level  Member</a></li>
                    <li class="sidebar-item">

                        <a class="sidebar-link" href="{{route('member.treeview')}}">Tree View</a></li>


                </ul>
            </li>

             <li class="sidebar-item   <?php echo PAGE=='account'?'active':'' ?>">
                 <a data-target="#account" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-dollar-sign"></i>
        <span class="align-middle">  Level Income</span>
     </a>
                 <ul id="account" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='account'?'show':'' ?>" data-parent="#sidebar" style="">

                     <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.income.level')}}">Level</a></li>

                     <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.income.earning')}}">Level  Income</a></li>
                     <li class="sidebar-item">

                         <a class="sidebar-link" href="{{route('member.income.all')}}"> All Level Income</a></li>
                 </ul>
             </li>



             <li class="sidebar-item   <?php echo PAGE=='repurchase'?'active':'' ?>">
                <a data-target="#repurchase" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-copy"></i>
       <span class="align-middle"> Repurchase Income</span>
    </a>
                <ul id="repurchase" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='repurchase'?'show':'' ?>" data-parent="#sidebar" style="">

                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.self.bv')}}">Self BV  </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.self.comission')}}">Self BV  Income</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.team.bv')}}">Team BV  </a></li>
                   
                        <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.team.comission')}}">Team BV  Income</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.team.levelbv')}}">Level BV  </a></li>

                        <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.buy.report')}}">Purchase Report</a></li>

                </ul>
            </li>

             <li class="sidebar-item   <?php echo PAGE=='withdrawal'?'active':'' ?>">
                 <a data-target="#withdrawal" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-comments-dollar"></i>
        <span class="align-middle">Withdrawal</span>
     </a>
                 <ul id="withdrawal" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='withdrawal'?'show':'' ?>" data-parent="#sidebar" style="">

                     <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.withdrawal.request.create')}}">Withdrawal Request</a></li>

                     <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.withdrawal.pending')}}">Pending  Withdrawal List</a></li>
                     <li class="sidebar-item">

                         <a class="sidebar-link" href="{{route('member.withdrawal.approved')}}"> Approved Withdrawal List</a></li>


                 </ul>
             </li>
         {{-- deposite  --}}
             <li class="sidebar-item   <?php echo PAGE=='deposite'?'active':'' ?>">
                 <a data-target="#deposite" data-toggle="collapse" class="sidebar-link" aria-expanded="false"> <i class="fas fa-university"></i>
        <span class="align-middle"> Manage Deposite</span>
     </a>
                 <ul id="deposite" class="sidebar-dropdown list-unstyled collapse <?php echo PAGE=='deposite'?'show':'' ?>" data-parent="#sidebar" style="">

                     <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.deposite.request.create')}}">Deposite Request</a></li>

                     <li class="sidebar-item"><a class="sidebar-link" href="{{route('member.deposite.pending')}}">Pending Deposite List</a></li>
                     <li class="sidebar-item">

                         <a class="sidebar-link" href="{{route('member.deposite.approved')}}">Approved Deposite List</a></li>

                         <li class="sidebar-item">

                            <a class="sidebar-link" href="{{route('member.deposite.rejected')}}">Rejected Deposite List</a></li>
                 </ul>
             </li>
             @endif
        </ul>
    </div>
</nav>
