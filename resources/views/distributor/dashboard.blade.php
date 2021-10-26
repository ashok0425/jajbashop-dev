@extends('distributor.master')
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
            $earning=DB::table('accounts')->where('user_id',__getDist()->id)->where('user_type',2)->sum('amount');
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
                    <div>
                        <i class="fas fa-rupee-sign  fa-3x text-success"></i>
                    </div>
                <div>
                    <h5 class="card-title mb-1 ">Comission Amount  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
{{$earning}}
                    </h1>
                </div>
               
                </div>
            </div>
        </div>

 <div class="col-sm-3 ">
            @php
            $earning=DB::table('orders')->where('user_id',__getDist()->id)->where('buyer',2)->sum('total');
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
                    <div>
                        <i class="fas fa-rupee-sign  fa-3x text-success"></i>
                    </div>
                <div>
                    <h5 class="card-title mb-1 "> Purchase Amount  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
{{$earning}}
                    </h1>
                </div>
            
                </div>
            </div>
        </div>



        <div class="col-sm-3 ">
            @php
            $earning=DB::table('orders')->where('user_id',__getDist()->id)->where('seller',2)->sum('total');
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
                    <div>
                        <i class="fas fa-rupee-sign  fa-3x text-info"></i>
                    </div>
                <div>
                    <h5 class="card-title mb-1 "> Sales Amount  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
              {{$earning}}
                    </h1>
                </div>
               
                </div>
            </div>
        </div>

 <div class="col-sm-3 ">
            @php
            $earning=DB::table('inventories')->where('user_id',__getDist()->id)->where('buyer',2)->get();
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
                    <div>
                        <i class="fas fa-copy fa-3x text-success"></i>
                    </div>
                <div>
                    <h5 class="card-title mb-1 "> Total Product  </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
              {{count($earning)}}
                    </h1>
                </div>
             
                </div>
            </div>
        </div>

 <div class="col-sm-3 ">
            @php
            $earning=DB::table('inventories')->where('user_id',__getDist()->id)->where('buyer',2)->sum('qty');
        @endphp
            <div class="card shadow">
                <div class="card-body py-4 d-flex justify-content-between">
                    <div>
                        <i class="fas fa-copy fa-3x text-warning"></i>
                    </div>
                <div>
                    <h5 class="card-title mb-1 "> Total Product Qty </h5>
                    <h1 class="mt-1 mb-1  font-weight-bold">
              {{$earning}}
                    </h1>
                </div>
              
                </div>
            </div>
        </div>
</div>
</div>




@endsection
