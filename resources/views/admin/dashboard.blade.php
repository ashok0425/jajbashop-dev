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

            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">

                <div>
                    <h5 class="card-title mb-1 ">Total Level income  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{ __getTotalLevelearning(10) }}


                    </h1>
                </div>
                <div>
                    <i class="fas fa-rupee-sign fa-3x text-success"></i>
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
                    <i class="fas fa-rupee-sign fa-3x text-success"></i>
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
                        {{__getTotalLevelearning(10)-$withdrawal}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-rupee-sign fa-3x text-danger"></i>
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
                    <i class="fas fa-rupee-sign fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>



        <div class="col-sm-3 ">
            @php
            $deposite=DB::table('orders')->sum('bv')
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Total BV  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$deposite}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-rupee-sign fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>


        <div class="col-sm-3 ">
            @php
            $bv=DB::table('orders')->where('buyer',1)->sum('bv')
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Total Member BV  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$bv}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-ad fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 ">
            @php
            $bv=DB::table('orders')->where('buyer',2)->sum('bv')
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Total Distributor BV  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$bv}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-ad fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3 ">
            @php
            $bv=DB::table('orders')->where('buyer',3)->sum('bv')
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Total Super BV  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$bv}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-ad fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 ">
            @php
            $total=DB::table('orders')->sum('total')
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Total Sold Amount  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$total}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-rupee-sign fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3 ">
            @php
            $total=DB::table('orders')->where('buyer',1)->sum('total')
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Total Member Amount  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$total}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-rupee-sign fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>



        

        <div class="col-sm-3 ">
            @php
            $total=DB::table('orders')->where('buyer',2)->sum('total')
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Total Distributor Amount  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$total}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-rupee-sign fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>
        

        <div class="col-sm-3 ">
            @php
            $total=DB::table('orders')->where('buyer',3)->sum('total')
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
      <div>
                    <h5 class="card-title mb-1 ">Total Super Amount  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
                        {{$total}}

                    </h1>
                </div>
                <div>
                    <i class="fas fa-rupee-sign fa-3x text-success"></i>
                </div>
                </div>
            </div>
        </div>
</div>
</div>




@endsection
