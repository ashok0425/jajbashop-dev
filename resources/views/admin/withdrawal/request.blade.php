@extends('admin.master')


@php
       define('PAGE','withdrawal')
@endphp
@section('main-content')
<div class="container-fluid">


    <div class="row">


        <div class="col-md-12 col-xl-12">
            @php
                $bank=DB::table('kycs')->where('user_id',Auth::user()->id)->where('status',1)->first();
            @endphp

<div class="card">
                    <h3 class=" mb-0">Withdrawal Request</h3>
                    <div class="text-white alert bg-warning mt-2 py-2 px-5"><h4 class="text-white">
                        Minimum Withdrawal Amount is Rs. 200, 15% Tax will be charged (5% TDS and 10% Admin).
                    </h3></div>
           <x-errormsg/>
           @if ($bank)

               <div class="card-body px-5">
<form action="{{route('member.withdrawal.request.store')}}" method="POST">
    @csrf
    <div class="form-group my-2">
        <label> Withdrawal Amount<span class="text-danger" >*</span></label>
        <input type="number" class="form-control" name="amount"  required >



    </div>


    <div class="form-group my-2">
        <label>Paying Amount (After deducating all the above mention charge)<span class="text-danger" >*</span></label>
        <input type="number" class="form-control" name="paying_amount"  required readonly>



    </div>
    <div class="form-group my-2">
        <label >Remark<span class="text-danger" >*</span></label>
        <textarea  class="form-control" name="remark" required>

        </textarea>
    </div>

    <div class="form-group mt-4">
        <input type="submit" class="form-control">

    </div>
</form>
               </div>
               @else
               <div class="card-body">
                   <div class="text-white alert bg-danger py-2 px-5"><h4 class="text-white">
                    Your KYC is not uploaded or approved yet!
                </h3></div>
               </div>
            </div>

            @endif

        </div>
    </div>

</div>
@endsection
