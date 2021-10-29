@extends('frontend.master')
@section('content')
<style>
      .razorpay-payment-button{
            padding: 7px 15px;
            background: var(--color-secondary)!important;
            border-radius: 2rem;
    
   border:0;
   outline: 0;
   color: #fff;
   width:300px;
   margin:auto;
   margin-top: 1rem;
      margin-bottom: 4rem;
      }
      .lds-ellipsis {
  display: flex;
  position: relative;
}
.lds-ellipsis div {
  position: absolute;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: #002658;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 8px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 8px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 32px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 56px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes lds-ellipsis2 {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(24px, 0);
  }
}

</style>
@if(Session::has('data'))
 
<div class="container tex-center mx-auto">
<form action="{{ route('razorpay.pay') }}" method="POST" class="text-center mx-auto mt-5">

<div class=" custom-fs-25 custom-fs-600 d-flex align-items-center justify-content-center">
    <div>
      Please click the button below and don't refresh the page 
    </div>
<div>
      
      <div class="lds-ellipsis mt-0 pt-0"><div></div><div></div><div></div><div></div></div>
</div>
</div>

     @csrf
      <script
      src="https://checkout.razorpay.com/v1/checkout.js"
      data-key="rzp_test_qTlC2erFpRl7nJ"
data-amount="{{Session::get('data.amount')}}" 
      data-currency="INR"
data-order_id="{{Session::get('data.order_id')}}"
      data-image="{{ asset('frontend/images/logo.JPG') }}"
      data-name="BaratoDeal PVT LTD"
      data-description="order transaction for the purchase of product from baratodeal.ins"
      data-prefill.name="{{Session::get('data.name')}}"
      data-prefill.email="{{Session::get('data.email')}}"
      data-prefill.contact="{{Session::get('data.phone')}}"
      data-theme.color="#002658"
      data-buttontext="Pay with Razorpay"
      data-buttoncolor="#002658"


  ></script>
  {{-- <input type="hidden" custom="Hidden Element" name="_token" value="{{ csrf_field()}}"> --}}
  </form>

</div>

@endif
@endsection