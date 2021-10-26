@extends('member.master')
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
                          Adhar Card Back: <a href="{{asset($bank->adhar_back)}}" download="{{$bank->name}}">
                            <img src="{{asset($bank->adhar_back)}}" alt="" width="60" height="60">
                          </a>
                        </p>
                        <p>
                            Adhar Card Front: <a href="{{asset($bank->adhar_front)}}" download="{{$bank->name}}">
                              <img src="{{asset($bank->adhar_front)}}" alt="" width="60" height="60">
                            </a>
                          </p>
                          <p>
                            Pan Copy: <a href="{{asset($bank->pancopy)}}" download="{{$bank->name}}">
                              <img src="{{asset($bank->pancopy)}}" alt="" width="60" height="60">
                            </a>
                          </p>
                          <p>
                            Bank Proof: <a href="{{asset($bank->bankproof)}}" download="{{$bank->name}}">
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
<a href="{{route('member.member.all')}}" class="btn btn-info">Back</a>

</div>
@endsection








