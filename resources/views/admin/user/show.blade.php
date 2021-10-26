@extends('admin.master')
<style>
    .font-weight-bold{
        font-size:1.1rem;
    }
</style>
@section('main-content')

@php
    define('PAGE','member')
@endphp
<div class="container-fluid mt-4">

  <div class="card">
    <h3>
        Detail of user:- {{$member->userid}}
    </h3>

  </div>

      <div class="row">
<div class="col-md-4">
    @php
    $earning=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l1',$member->userid)->sum('levelearnings.l1');
@endphp
    @php
    $earning2=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l2',$member->userid)->sum('levelearnings.l2');
@endphp
 @php
 $earning3=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l3',$member->userid)->sum('levelearnings.l3');
@endphp
@php
$earning4=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l4',$member->userid)->sum('levelearnings.l4');
@endphp
@php
$earning5=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l5',$member->userid)->sum('levelearnings.l5');
@endphp
@php
$earning6=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l6',$member->userid)->sum('levelearnings.l6');
@endphp @php
$earning7=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l7',$member->userid)->sum('levelearnings.l7');
@endphp
@php
$earning8=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l8',$member->userid)->sum('levelearnings.l8');
@endphp
@php
$earning9=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l9',$member->userid)->sum('levelearnings.l9');
@endphp
@php
$earning10=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l10',$member->userid)->sum('levelearnings.l10');
@endphp
<div class="card">
    <div class="card-header">
        <h4>Account Details</h4>
            </div>
   <div class="card-body">
    <div class="text-success font-weight-bold"> Direct Sponsor Income: {{$earning}}</div>
    <div class="text-success font-weight-bold"> Level Income: {{$earning2 + $earning3+ $earning4 + $earning5+ $earning6+ $earning7 +$earning8+ $earning9 + $earning10}}</div>

    <div class="text-success font-weight-bold">Total  Income: {{$total=$earning2 + $earning3+ $earning4 + $earning5+ $earning6+ $earning7 +$earning8+ $earning9 + $earning10 +$earning}}</div>

   @php
    $withdrawal=DB::table('withdrawals')->where('user_id',$member->userid)->where('status',2)->sum('amount')
@endphp
   <div class="text-success font-weight-bold">Total Withdrawal: {{$withdrawal}}</div>
   <div class="text-success font-weight-bold">Pending Amount: {{$total-$withdrawal}}</div>
   @php
   $deposite=DB::table('deposites')->where('user_id',$member->userid)->where('status',2)->sum('amount');
@endphp
   <div class="text-success font-weight-bold">Total Deposite: {{$deposite}}</div>

</div>

</div>

</div>

        <div class="col-md-4">
<div class="card">
    <div class="card-header">
<h4>User Detail</h4>
    </div>
    <div class="card-body">
<p>
    Name: {{$member->name}}
</p>
<p>
    Username: {{$member->userid}}
</p>
<p>
    Phone: {{$member->phone}}
</p>
<p>
    Email: {{$member->email}}
</p>
<p>
    Adhar Card No: {{$member->adhar}}
</p>
<p>
    Status:   @if (!empty($member->status))
    <span class="badge bg-success">Active</span>
    @else
    <span class="badge bg-danger">Inactive</span>

    @endif
</p>
<p>
   Sponsored By: {{$member->sponsor_id}}
</p>
<p>
    Registered On: {{carbon\carbon::parse($member->created_at)->format('d F Y')}}
</p>
    </div>
</div>
        </div>

@if (isset($bank))

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
            <h4>Bank Detail</h4>
                </div>
                <div class="card-body">
            <p>
                Account Name: {{$bank->name}}
            </p>
            <p>
                Bank : {{$bank->Bank_name}}
            </p>
            <p>
                Account No: {{$bank->account_no}}
            </p>
            <p>
             IFSC: {{$bank->ifsc}}
            </p>
            <p>
                Pan No: {{$bank->pan_no}}
            </p>
            <p>
                Adhar Card No: {{$bank->adhar_card_no}}
            </p>
            <p>
                Google Pay ID: {{$bank->google_pay_id}}
            </p>
            <p>
                Phone Pay ID: {{$bank->phone_pay_id}}
            </p>
            <p>
                Last Updated On: {{carbon\carbon::parse($bank->updated_at)->format('d F Y')}}
            </p>
                </div>
            </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                        <h4>Account Proof</h4>
                            </div>
                            <div class="card-body">
                        <p>
                          Adhar Card Back: <a href="{{asset($bank->adhar_back)}}" download="{{$member->name}}">
                            <img src="{{asset($bank->adhar_back)}}" alt="" width="60" height="60">
                          </a>
                        </p>
                        <p>
                            Adhar Card Front: <a href="{{asset($bank->adhar_front)}}" download="{{$member->name}}">
                              <img src="{{asset($bank->adhar_front)}}" alt="" width="60" height="60">
                            </a>
                          </p>
                          <p>
                            Pan Copy: <a href="{{asset($bank->pancopy)}}" download="{{$member->name}}">
                              <img src="{{asset($bank->pancopy)}}" alt="" width="60" height="60">
                            </a>
                          </p>
                          <p>
                            Bank Proof: <a href="{{asset($bank->bankproof)}}" download="{{$member->name}}">
                              <img src="{{asset($bank->bankproof)}}" alt="" width="60" height="60">
                            </a>
                          </p>
                            </div>
                        </div>
                                </div>
                                @else
                                <div class="col-md-4">
                                    <div class='card py-3 px-3'>
                                        <h4 class="text-danger">KYC Not Updated</h4>
                                    </div>
                                </div>

@endif

      </div>
    <a href="{{route('admin.user.all')}}" class="btn btn-info">Back</a>

</div>
@endsection








