@extends('member.master')
@section('main-content')
<style>
    .rotate{
        transform: rotateY(180deg)!important;
    }
    .card{
        border: 0;
        border-radius: 0;
        font-size: 14px;
    }
</style>
@php
    define('PAGE','dashboard')
@endphp
<div class="container-fluid p-0">

    <div class="row">

        <div class="col-sm-3  col-6">
            <div class="card @if (Auth::user()->status!=null)
                bg-success
                @else
                bg-danger

            @endif shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    @if (Auth::user()->status==null)

                    <h5 class="card-title mb-1 text-white">ID Status </h5>
                    @endif
                    <h1 class="mt-1 mb-1 text-white font-weight-bold">
                        @if (Auth::user()->status==null)
                        Inactive
                        <span type="button" class="btn btn-primary active_btn" data-toggle="modal" data-target="#exampleModal" >
                            Active Now
                        </span>
                        @else
                       <small>
                        Level
                       </small>
                       <br>
                       
                        <strong class="text-warning">
                              {{   __getMyrank()}}
                           </strong>
                    @endif
                
                    </h1>
                     
                 


                      

                </div>
                <div>
                    <i class="fas fa-user text-white fa-3x"></i>
                </div>
                </div>
            </div>
        </div>


        <div class="col-sm-3  col-6 ">
            @php
               $member=DB::table('users')->join('levels','levels.user_id','users.id')->where(function($level){
$level->where('levels.l1',Auth::user()->userid)->orwhere('levels.l2',Auth::user()->userid)->orwhere('levels.l3',Auth::user()->userid)->orwhere('levels.l4',Auth::user()->userid)->orwhere('levels.l5',Auth::user()->userid)->orwhere('levels.l6',Auth::user()->userid)->orwhere('levels.l7',Auth::user()->userid)->orwhere('levels.l8',Auth::user()->userid)->orwhere('levels.l9',Auth::user()->userid)->orwhere('levels.l10',Auth::user()->userid)->orwhere('levels.l11',Auth::user()->userid)->orwhere('levels.l12',Auth::user()->userid)->orwhere('levels.l13',Auth::user()->userid)->orwhere('levels.l14',Auth::user()->userid)->orwhere('levels.l15',Auth::user()->userid);
        })->orderBy('users.id','desc')->get();
            @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Total Member  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
{{count($member)}}
                    </h1>
                </div>
                <div>
                    <i class="fas fa-users text-info fa-3x"></i>
                </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3  col-6 ">
            @php
               $member=DB::table('users')->join('levels','levels.user_id','users.id')->where(function($level){
$level->where('levels.l1',Auth::user()->userid)->orwhere('levels.l2',Auth::user()->userid)->orwhere('levels.l3',Auth::user()->userid)->orwhere('levels.l4',Auth::user()->userid)->orwhere('levels.l5',Auth::user()->userid)->orwhere('levels.l6',Auth::user()->userid)->orwhere('levels.l7',Auth::user()->userid)->orwhere('levels.l8',Auth::user()->userid)->orwhere('levels.l9',Auth::user()->userid)->orwhere('levels.l10',Auth::user()->userid)->orwhere('levels.l11',Auth::user()->userid)->orwhere('levels.l12',Auth::user()->userid)->orwhere('levels.l13',Auth::user()->userid)->orwhere('levels.l14',Auth::user()->userid)->orwhere('levels.l15',Auth::user()->userid);
        })->orderBy('users.id','desc')->where('users.status',null)->get();
            @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Inactive Member  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
{{count($member)}}
                    </h1>
                </div>
                <div>
                    <i class="fas fa-users fa-3x text-danger"></i>
                </div>
                </div>
            </div>
        </div>




        <div class="col-sm-3  col-6 ">
            @php
               $member=DB::table('users')->join('levels','levels.user_id','users.id')->where(function($level){
$level->where('levels.l1',Auth::user()->userid)->orwhere('levels.l2',Auth::user()->userid)->orwhere('levels.l3',Auth::user()->userid)->orwhere('levels.l4',Auth::user()->userid)->orwhere('levels.l5',Auth::user()->userid)->orwhere('levels.l6',Auth::user()->userid)->orwhere('levels.l7',Auth::user()->userid)->orwhere('levels.l8',Auth::user()->userid)->orwhere('levels.l9',Auth::user()->userid)->orwhere('levels.l10',Auth::user()->userid)->orwhere('levels.l11',Auth::user()->userid)->orwhere('levels.l12',Auth::user()->userid)->orwhere('levels.l13',Auth::user()->userid)->orwhere('levels.l14',Auth::user()->userid)->orwhere('levels.l15',Auth::user()->userid);
        })->orderBy('users.id','desc')->where('users.status','!=',null)->get();
            @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Active Member  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
{{count($member)}}
                    </h1>
                </div>
                <div>
                    <i class="fas fa-users fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>





        <div class="col-sm-3  col-6 ">
            @php
            $earning=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l1',Auth::user()->userid)->sum('levelearnings.l1');
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Direct Member income  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
{{$earning}}
                    </h1>
                </div>
                <div>
                    <i class="fas fa-money-bill-wave fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>








        <div class="col-sm-3  col-6 ">
           

            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Level income  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                         {{  __getTotalLevelearning(10,3,2) }}
                    </h1>
                </div>
                <div>
                    <i class="fas fa-money-bill-wave fa-3x text-info"></i>
                </div>
                </div>
            </div>
        </div>





        <div class="col-sm-3  col-6 ">

            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Total income  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{  __getTotalLevelearning(10,3) }}


                    </h1>
                </div>
                <div>
                    <i class="fas fa-wallet fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>



        <div class="col-sm-3  col-6 ">

            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
@php
    $withdrawal=DB::table('withdrawals')->where('user_id',Auth::user()->id)->where('status',2)->sum('amount')
@endphp
                <div>
                    <h5 class="card-title mb-1 ">Total Withdrawal  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$withdrawal}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-wallet fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>



        <div class="col-sm-3  col-6 ">

            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Pending Income  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                         {{  __getTotalLevelearning(10,3)-$withdrawal}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-wallet fa-3x text-danger"></i>
                </div>
                </div>
            </div>
        </div>


        <div class="col-sm-3  col-6 ">
            @php
            $deposite=DB::table('deposites')->where('user_id',Auth::user()->id)->where('status',2)->sum('amount');
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Total Deposite  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$deposite}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-rupee-sign fa-3x text-info"></i>
                </div>
                </div>
            </div>
        </div>

        {{-- My bv  --}}
        <div class="col-sm-3  col-6 ">
            @php
            $mybv=DB::table('userbvs')->where('user_id',Auth::user()->id)->value('bv');
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Self BV  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        @if (isset($mybv))
                        {{$mybv-__getTotalLevelbv(100,3)}}
                          @else   
                          0  
                        @endif

                    </h1>
                </div>
                <div>
                    <i class="fas fa-money-bill-wave fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>


        {{-- Level Bv income  --}}

<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">

        <div>
            <h5 class="card-title mb-1 ">Team BV  </h5>
            <h1 class="mt-1 mb-1  font-weight-bold">
         {{__getTotalLevelbv(100,3)}}
            </h1>
        </div>
        <div>
            <i class="fas fa-money-bill-wave fa-3x text-info"></i>
        </div>
        </div>
    </div>
</div>


        {{-- Total BV  --}}

        <div class="col-sm-3  col-6 ">
          
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Total BV  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        @if (isset($mybv))
{{$mybv+__getTotalLevelbv(100,3)}}
                          @else   
                          0  
                        @endif

                    </h1>
                </div>
                <div>
                    <i class="fas fa-money-bill-wave fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>



               {{-- My Comission  --}}

               <div class="col-sm-3  col-6 ">
                @php
                $mycomission=DB::table('mycomissions')->where('user_id',Auth::user()->id)->value('comission');
            @endphp
                <div class="card shadow">
                    <div class="card-body py-4 d-flex justify-content-between">
    
                    <div>
                        <h5 class="card-title mb-1 ">Self Repurchase Income  </h5>
                        <h1 class="mt-1 mb-1  font-weight-bold">    
   @if ($mycomission)
   {{ $mycomission }}
       @else  
       0
   @endif
                        </h1>
                    </div>
                    <div>
                        <i class="fas fa-money-bill-wave fa-3x text-success"></i>
                    </div>
                    </div>
                </div>
            </div>



{{-- Level comisiion income  --}}

<div class="col-sm-3  col-6 ">
   
    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">

        <div>
            <h5 class="card-title mb-1 ">Team Repurchase Income  </h5>
            <h1 class="mt-1 mb-1  font-weight-bold">
{{__getTotalrepurchasecomm(100,3)}}
            </h1>
        </div>
        <div>
            <i class="fas fa-money-bill-wave fa-3x text-info"></i>
        </div>
        </div>
    </div>
</div>



          {{-- Total Comission  --}}

          <div class="col-sm-3  col-6 ">
       
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Total Repurchase Income  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">   
                        @if ($mycomission)
                           
{{$mycomission+__getTotalrepurchasecomm(100,6)}} 
@else     
                0            
@endif 
                    </h1>
                </div>
                <div>
                    <i class="fas fa-rupee-sign fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>



          {{-- Total Comission  --}}

          <div class="col-sm-3  col-6 ">
       
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Grand Total Income  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">   
                        @if ($mycomission)
                           
                        {{$mycomission +  __getTotalrepurchasecomm(100,3)  + __getTotalLevelearning(10,3) }}
                      @endif

                    </h1>
                </div>
                <div>
                    <i class="fas fa-rupee-sign fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>


</div>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
<div class="card-body">
   <div class="d-flex ">
                <!-- The text field -->
<input type="text" value="{{route('member.refer.register',['name'=>Auth::user()->name,'userid'=>Auth::user()->userid,'id'=>Auth::user()->id])}}" id="myInput" readonly style='width:500px;'>
<!-- The button used to copy the text -->
<button onclick="myFunction()" class="btn btn-sm btn-info" >Copy Link</button>
   </div>
</div>
        </div>
    </div>
</div>
<h3>Reward</h3>
<div class="row">
    {{-- reward 1  --}}
    @php
    $member=DB::table('levels')->where('l1',Auth::user()->userid)->get();  
   @endphp
@if (count($member)>=4)
    
<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">
<div>
            <h5 class="card-title mb-1 ">Reward Voucher   </h5>
            <h6 class="mt-1 mb-1  font-weight-bold">
                500/- 8Month Free Product

            </h6>
        </div>
        <div>
            <i class="fas fa-copy  text-info"></i>
        </div>
        </div>
    </div>
</div>
@endif


    {{-- reward 2 --}}
    @php
    $member=DB::table('levels')->where('l2',Auth::user()->userid)->get();  
   @endphp
@if (count($member)>=16)
    
<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">
<div>
            <h5 class="card-title mb-1 ">Reward Voucher   </h5>
            <h6 class="mt-1 mb-1  font-weight-bold">
                Free Traning with Facility


            </h6>
        </div>
        <div>
            <i class="fas fa-copy  text-info"></i>
        </div>
        </div>
    </div>
</div>
@endif



    {{-- reward 3  --}}
    @php
    $member=DB::table('levels')->where('l3',Auth::user()->userid)->get();  
   @endphp
@if (count($member)>=64)
    
<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">
<div>
            <h5 class="card-title mb-1 ">Reward Voucher   </h5>
            <h6 class="mt-1 mb-1  font-weight-bold">
                Mixer Grinder / 5Ltr. Rice Cooker / Fan

            </h6>
        </div>
        <div>
            <i class="fas fa-copy fa-3x text-info"></i>
        </div>
        </div>
    </div>
</div>
@endif


    {{-- reward 4  --}}
    @php
    $member=DB::table('levels')->where('l4',Auth::user()->userid)->get();  
   @endphp
@if (count($member)>=256)
    
<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">
<div>
            <h5 class="card-title mb-1 ">Reward Voucher   </h5>
            <h6 class="mt-1 mb-1  font-weight-bold">
                Smartphone / 26’’ LED TV


            </h6>
        </div>
        <div>
            <i class="fas fa-copy fa-3x text-info"></i>
        </div>
        </div>
    </div>
</div>
@endif



    {{-- reward 5  --}}
    @php
    $member=DB::table('levels')->where('l5',Auth::user()->userid)->get();  
   @endphp
@if (count($member)>=1024)
    
<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">
<div>
            <h5 class="card-title mb-1 ">Reward Voucher   </h5>
            <h6 class="mt-1 mb-1  font-weight-bold">
                Bike (25,000 /- Finance)

            </h6>
        </div>
        <div>
            <i class="fas fa-copy fa-3x text-info"></i>
        </div>
        </div>
    </div>
</div>
@endif

    {{-- reward 6  --}}
    @php
    $member=DB::table('levels')->where('l6',Auth::user()->userid)->get();  
   @endphp
@if (count($member)>4096)
    
<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">
<div>
            <h5 class="card-title mb-1 ">Reward Voucher   </h5>
            <h6 class="mt-1 mb-1  font-weight-bold">
                Car (1 Lakh Finance)


            </h6>
        </div>
        <div>
            <i class="fas fa-copy fa-3x text-info"></i>
        </div>
        </div>
    </div>
</div>
@endif

    {{-- reward 7  --}}
    @php
    $member=DB::table('levels')->where('l7',Auth::user()->userid)->get();  
   @endphp
@if (count($member)>=16384)
    
<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">
<div>
            <h5 class="card-title mb-1 ">Reward Voucher   </h5>
            <h6 class="mt-1 mb-1  font-weight-bold">
                Swift Dezire ( Full Paid 

            </h6>
        </div>
        <div>
            <i class="fas fa-copy fa-3x text-info"></i>
        </div>
        </div>
    </div>
</div>
@endif

    {{-- reward 8 --}}
    @php
    $member=DB::table('levels')->where('l8',Auth::user()->userid)->get();  
   @endphp
@if (count($member)>65536)
    
<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">
<div>
            <h5 class="card-title mb-1 ">Reward Voucher   </h5>
            <h6 class="mt-1 mb-1  font-weight-bold">
                House Fund, / 20 Lakh

            </h6>
        </div>
        <div>
            <i class="fas fa-copy fa-3x text-info"></i>
        </div>
        </div>
    </div>
</div>
@endif

    {{-- reward 9  --}}
    @php
    $member=DB::table('levels')->where('l9',Auth::user()->userid)->get();  
   @endphp
@if (count($member)>262144)
    
<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">
<div>
            <h5 class="card-title mb-1 ">Reward Voucher   </h5>
            <h6 class="mt-1 mb-1  font-weight-bold">
                BMW, / 40 Lakh.

            </h6>
        </div>
        <div>
            <i class="fas fa-copy fa-3x text-info"></i>
        </div>
        </div>
    </div>
</div>
@endif

    {{-- reward 10  --}}
    @php
    $member=DB::table('levels')->where('l10',Auth::user()->userid)->get();  
   @endphp
@if (count($member)>1048576)
    
<div class="col-sm-3  col-6 ">

    <div class="card shadow">
        <div class="card-body py-4 d-flex justify-content-between">
<div>
            <h5 class="card-title mb-1 ">Reward Voucher   </h5>
            <h6 class="mt-1 mb-1  font-weight-bold">
                Range Rover, / 1 crore

            </h6>
        </div>
        <div>
            <i class="fas fa-copy fa-3x text-info"></i>
        </div>
        </div>
    </div>
</div>
@endif























</div>
</div>



@endsection

@push('scripts')
<script>
    function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>
@endpush
