@extends('admin.master')
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



        <div class="col-sm-3 ">
            @php
               $member=DB::table('users')->get();
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

        <div class="col-sm-3 ">
            @php
               $member=DB::table('users')->where('users.status',null)->get();
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




        <div class="col-sm-3 ">
            @php
               $member=DB::table('users')->where('users.status','!=',null)->get();
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





        <div class="col-sm-3 ">
            @php
            $earning=DB::table('levelearnings')->sum('l1');
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
                    <i class="fas fa-dollar-sign fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>








        <div class="col-sm-3 ">
            @php
                       $earning2=DB::table('levelearnings')->sum('l2');
                       $earning3=DB::table('levelearnings')->sum('l3');
                       $earning4=DB::table('levelearnings')->sum('l4');
                       $earning5=DB::table('levelearnings')->sum('l5');
                       $earning6=DB::table('levelearnings')->sum('l6');
                       $earning7=DB::table('levelearnings')->sum('l7');
                       $earning8=DB::table('levelearnings')->sum('l8');
                       $earning9=DB::table('levelearnings')->sum('l9');
                       $earning10=DB::table('levelearnings')->sum('l10');


        @endphp


            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Level income  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
{{$earning2 + $earning3+ $earning4 + $earning5+ $earning6+ $earning7 +$earning8+ $earning9 + $earning10}}
                    </h1>
                </div>
                <div>
                    <i class="fas fa-dollar-sign fa-3x text-info"></i>
                </div>
                </div>
            </div>
        </div>





        <div class="col-sm-3 ">

            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Total income  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$earn=$earning+$earning2 + $earning3+ $earning4 + $earning5+ $earning6+ $earning7 +$earning8+ $earning9 + $earning10}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-comments-dollar fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>



        <div class="col-sm-3 ">

            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
@php
    $withdrawal=DB::table('withdrawals')->where('status',2)->sum('amount')
@endphp
                <div>
                    <h5 class="card-title mb-1 ">Total Withdrawal  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$withdrawal}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-comments-dollar fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>



        <div class="col-sm-3 ">

            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Pending Income  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$earn-$withdrawal}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-comments-dollar fa-3x text-danger"></i>
                </div>
                </div>
            </div>
        </div>


        <div class="col-sm-3 ">
            @php
            $deposite=DB::table('deposites')->where('status',2)->sum('amount')
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
                    <i class="fas fa-comment-dollar fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>
</div>
</div>




@endsection
