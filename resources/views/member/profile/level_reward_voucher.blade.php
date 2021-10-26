@extends('member.master')
@php
       define('PAGE','profile')
@endphp
@section('main-content')
<div class="container-fluid p-0">

            <div class="card">
                <h3>Level Reward voucher</h3>
                <div class="card-body">
            @if (count($member)>4)
            <div class="row">

                @for ($i = 0; $i <=8; $i++)
                    <div class="col-md-3">
                   
                        <div class="card shadow">
                            <div class="card-body py-4 d-flex justify-content-between">
                
                            <div>
                                <h5 class="card-title mb-1 ">Voucher {{ $i }}  </h5>
                                <h1 class="mt-1 mb-1  font-weight-bold">
                                    {{  __getPriceunit() }} 500
                                </h1>
                            </div>
                            <div>
                                <i class="fas fa-copy text-info fa-3x"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            @else   
          <h5 class="alert alert-info mt-5 py-2 px-3">No Level Reward Voucher.In order to have Level Reward Voucher,there must be 4 member in your level 1</h5>
            
            @endif
        </div>
            </div>
        </div>

@endsection
