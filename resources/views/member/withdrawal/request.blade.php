@extends('member.master')

@php
       define('PAGE','withdrawal')
@endphp
@section('main-content')
<div class="container-fluid">


    <div class="row">
{{-- geeting total earning for all level  --}}
        @php
        $earning=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l1',Auth::user()->userid)->sum('levelearnings.l1');
    @endphp
        @php
        $earning2=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l2',Auth::user()->userid)->sum('levelearnings.l2');
    @endphp
     @php
     $earning3=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l3',Auth::user()->userid)->sum('levelearnings.l3');
    @endphp
    @php
    $earning4=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l4',Auth::user()->userid)->sum('levelearnings.l4');
    @endphp
    @php
    $earning5=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l5',Auth::user()->userid)->sum('levelearnings.l5');
    @endphp
    @php
    $earning6=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l6',Auth::user()->userid)->sum('levelearnings.l6');
    @endphp @php
    $earning7=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l7',Auth::user()->userid)->sum('levelearnings.l7');
    @endphp
    @php
    $earning8=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l8',Auth::user()->userid)->sum('levelearnings.l8');
    @endphp
    @php
    $earning9=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l9',Auth::user()->userid)->sum('levelearnings.l9');
    @endphp
    @php
    $earning10=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l10',Auth::user()->userid)->sum('levelearnings.l10');
    @endphp
        <div class="col-md-12 col-xl-12">
         @php
                $bank=DB::table('kycs')->where('user_id',Auth::user()->id)->where('status',2)->first();
            @endphp

<div class="card">

                    <h3 class=" mb-0">Withdrawal Request</h3>
                    <div class="text-white alert bg-warning mt-2 py-2 px-5"><h4 class="text-white">
                        Minimum Withdrawal Amount is Rs. 200, 15% Tax will be charged (5% TDS and 10% Admin).
                    </h3></div>
           <x-errormsg/>
           @if ($bank)

               <div class="card-body px-5">
                <div class="text-success font-weight-bold">Total  Income: {{$total=$earning2 + $earning3+ $earning4 + $earning5+ $earning6+ $earning7 +$earning8+ $earning9 + $earning10 +$earning}}</div>

                @php
                 $withdrawal=DB::table('withdrawals')->where('user_id',Auth::user()->id)->where('status',2)->sum('amount');
                 $last=DB::table('withdrawals')->where('user_id',Auth::user()->id)->latest()->first();
             @endphp
                <div class="text-success font-weight-bold">Total Withdrawal: {{$withdrawal}}</div>
                <div class="text-success font-weight-bold">Pending Amount: {{$pending=$total-$withdrawal}}</div>
                {{-- storing pending amount to session  --}}
                @php
session()->forget('pending');

session()->put('pending',$pending);
                @endphp
<form action="{{route('member.withdrawal.request.store')}}" method="POST">
    @csrf
    <div class="form-group my-2">
        <label> Withdrawal Amount<span class="text-danger" >*</span></label>
        <input type="number" class="form-control" name="amount"  required max="{{$total-$withdrawal}}">



    </div>

{{--
    <div class="form-group my-2">
        <label>Paying Amount (After deducating all the above mention charge)<span class="text-danger" >*</span></label>
        <input type="number" class="form-control" name="paying_amount"  required readonly>



    </div> --}}
    <div class="form-group my-2">
        <label >Remark<span class="text-danger" >*</span></label>
        <textarea  class="form-control" name="remark" required>

        </textarea>
    </div>

    <div class="form-group mt-4">

        @if ($pending<=200)
        <div class="text-white alert bg-danger py-2 px-5"><h4 class="text-white">
            Your Account balace is less than 200.Try withdrwawal request once it is more than 200.

        </h3></div>
        @elseif(isset($last)&&$last->status==2||$last->status==1)
        <input type="submit" class="form-control">


        @else
        <div class="text-white alert bg-danger py-2 px-5"><h4 class="text-white">
            Your Latest with drawal request in in Review.You are only able to request other withdrawal once the latest withdrawal is approved.

        </h3></div>

        @endif

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
