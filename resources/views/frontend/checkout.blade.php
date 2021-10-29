@push('style')
<style>
  .border_bottom{
    border: 0;
   outline: 0;
   box-shadow: 0;
    border: 1px solid black!important;
    border-radius: 0;
  }
  .border_bottom:focus{
   box-shadow: none!important;
   outline: 0!important;


  }

  input[name='payment_type'] {
        /* display: none; */
     height: 1.4rem;
     width: 1.4rem;
    
    }
</style>
@endpush
{{-- checking wheter the process is buy now or not  --}}
@if ($buynow==0)
  @php
      $cart=DB::table('carts')->join('products','carts.product_id','products.id')->where('user_id',Auth::user()->id)->where('buynow',0)->select('carts.*','products.delivery_charge')->get();
  @endphp
@elseif ($buynow==1)
@php
           $cart=DB::table('carts')->join('products','carts.product_id','products.id')->where('user_id',Auth::user()->id)->where('buynow',1)->select('carts.*','products.delivery_charge')->get();

    
@endphp
@endif
@php
    $subtotal=0;
    $charge=0;
  $detail=DB::table('shipping_addresses')->where('user_id',Auth::user()->id)->first();
@endphp
{{-- foreach to calculate total amount --}}
@foreach ($cart as $item)
   @php
       
       $subtotal+=$item->qty*$item->price;
       $charge+=$item->qty*$item->delivery_charge;

   @endphp
@endforeach

@extends('frontend.master')
@section('header')
<section class="section-pagetop bg_gray ">
    <div class="container">
        <h2 class="title-page">Checkout</h2>
    </div> <!-- container //  -->
    </section>
@endsection
@section('content')
    
<div class="container py-2 my-5">
  <form action="{{ route('checkout.store') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-8 order-md-1 order-2">

      <div class="card shadow-sm pb-4">
        <div class="card-header custom-fs-25 custom-fw-700">
          Shipping Detail
          <p class="pb-0 custom-fs-15 custom-fw-500">Please Feel Free To Check Your Billing Details And Shipping Details.</p>
        </div>
   <div class="card-body">
     <x-errormsg/>
    
      <input type="hidden" value="{{ $buynow }}" name="buynow">
      <div class="row">
        <div class="col-md-6 my-2">
          <label class="mb-0 pb-0 custom-fw-600">Full Name<span class="text-danger custom-fw-800">*</span></label>
          <input type="text" class=" border_bottom form-control py-0 my-0" name="name" required value="{{ Auth::user()->name }}" id="name">
        </div>
        <div class="col-md-6 my-2">
           <label class="mb-0 pb-0 custom-fw-600">Email Address<span class="text-danger custom-fw-800">*</span></label>
           <input type="email" class=" border_bottom form-control py-0 my-0" required name="email" value="{{ Auth::user()->email}} " id="email">
        </div>
        <div class="col-md-6 my-2">
          <label class="mb-0 pb-0 custom-fw-600">Phone No.<span class="text-danger custom-fw-800">*</span></label>
          <input type="number" class=" border_bottom form-control py-0 my-0" required name="phone" value="{{Auth::user()->phone }}" id="phone">
       </div>

       <div class="col-md-6 my-2">
        <label class="mb-0 pb-0 custom-fw-600">State <span class="text-danger custom-fw-800">*</span></label>
        <input type="text" class=" border_bottom form-control py-0 my-0" required name="state" value="@if(isset($detail)) {{$detail->state}} @endif" id="state">
     </div>

     <div class="col-md-6 my-2">
      <label class="mb-0 pb-0 custom-fw-600">District <span class="text-danger custom-fw-800">*</span></label>
      <input type="text" class=" border_bottom form-control py-0 my-0" required name="district" value="@if(isset($detail)) {{$detail->district}} @endif" id="district">
   </div>

     <div class="col-md-6 my-2">
      <label class="mb-0 pb-0 custom-fw-600">City <span class="text-danger custom-fw-800">*</span></label>
      <input type="text" class=" border_bottom form-control py-0 my-0" name="city" required value="@if(isset($detail)) {{$detail->city}} @endif" id="city">
   </div>

   <div class="col-md-6 my-2">
    <label class="mb-0 pb-0 custom-fw-600">Address <span class="text-danger custom-fw-800">*</span></label>
    <input type="text" class=" border_bottom form-control py-0 my-0" name="address" required value="@if(isset($detail)) {{$detail->address}} @endif" id="address">
 </div>


 <div class="col-md-6 my-2">
  <label class="mb-0 pb-0 custom-fw-600">Zip Code <span class="text-danger custom-fw-800">*</span></label>
  <input type="text" class=" border_bottom form-control py-0 my-0" name="zip_code" required value="@if(isset($detail)) {{$detail->pincode}} @endif" id="zip_code">
</div>
<div class="col-md-12 my-2">
  <label class="mb-0 pb-0 custom-fw-600">GST No. (optional) </label>
  <input type="text" class=" border_bottom form-control py-0 my-0" name="gst"  value="{{ old('gst') }}" id="gst">
</div>
<div class="col-md-12 my-2">
  <label class="mb-0 pb-0 custom-fw-500 d-flexalign-items-center"><input type="checkbox" name="" id="is_same"> Billing Detail is same As Shipping Detail </label>
</div>

{{-- billing address  --}}
<div class="billing row " id="billing">
  <div class="card-header custom-fs-25 custom-fw-700">
    Billing Detail
  </div>

  <div class="col-md-6 my-2">
    <label class="mb-0 pb-0 custom-fw-600">Full Name<span class="text-danger custom-fw-800">*</span></label>
    <input type="text" class=" border_bottom form-control py-0 my-0 isreq" name="bname"  id="bname" required>
  </div>
  <div class="col-md-6 my-2">
     <label class="mb-0 pb-0 custom-fw-600">Email Address<span class="text-danger custom-fw-800">*</span></label>
     <input type="email" class=" border_bottom form-control py-0 my-0 isreq"  name="bemail" id="bemail">
  </div>
  <div class="col-md-6 my-2">
    <label class="mb-0 pb-0 custom-fw-600">Phone No.<span class="text-danger custom-fw-800">*</span></label>
    <input type="number" class=" border_bottom form-control py-0 my-0 isreq"  name="bphone" id="bphone" required>
 </div>

 <div class="col-md-6 my-2" >
  <label class="mb-0 pb-0 custom-fw-600">State <span class="text-danger custom-fw-800">*</span></label>
  <input type="text" class=" border_bottom form-control py-0 my-0 isreq"  name="bstate" id="bstate" required>
</div>

<div class="col-md-6 my-2">
<label class="mb-0 pb-0 custom-fw-600">District <span class="text-danger custom-fw-800">*</span></label>
<input type="text" class=" border_bottom form-control py-0 my-0 isreq"  name="bdistrict" id="bdistrict" required> 
</div>

<div class="col-md-6 my-2">
<label class="mb-0 pb-0 custom-fw-600">City <span class="text-danger custom-fw-800">*</span></label>
<input type="text" class=" border_bottom form-control py-0 my-0 isreq" name="bcity"  id="bcity" required>
</div>

<div class="col-md-6 my-2">
<label class="mb-0 pb-0 custom-fw-600">Address <span class="text-danger custom-fw-800">*</span></label>
<input type="text" class=" border_bottom form-control py-0 my-0 isreq" name="baddress"  id="baddress" required>
</div>


<div class="col-md-6 my-2">
<label class="mb-0 pb-0 custom-fw-600">Zip Code <span class="text-danger custom-fw-800">*</span></label>
<input type="text" class=" border_bottom form-control py-0 my-0  isreq" name="bzip_code"  id="bzip_code" required>
</div>
<div class="col-md-12 my-2">
  <label class="mb-0 pb-0 custom-fw-600">GST No. (optional) </label>
  <input type="text" class=" border_bottom form-control py-0 my-0" name="bgst"  value="{{ old('gst') }}" id="bgst" >
</div>
</div>



      </div>

  
    
   </div>
  </div>

    </div>
    {{-- col-md-8 end  --}}

    <div class="col-md-4 order-1 order-md-2">
      <div class="card shadow-sm">
   <div class="card-header">
     Order Summary's
   </div>
   

@if (session()->has('coupon'))
<div class="card-body">
  <div class="d-flex justify-content-between">
   <p>Sub Total</p>
   <p>{{ __getPriceunit() }} {{ session()->get('coupon')['balance'] }}</p>
  </div>
  <div class="d-flex justify-content-between">
   <p>Delivery Charge</p>
   <p>{{ __getPriceunit() }} {{ $charge }}</p>
  </div>

  <div class="d-flex justify-content-between">
   <p>Grand Total</p>
   <p>{{ __getPriceunit() }} {{ session()->get('coupon')['balance'] +$charge }}</p>
  </div>
</div>
@else   
<div class="card-body">
  <div class="d-flex justify-content-between">
   <p>Sub Total</p>
   <p>{{ __getPriceunit() }} {{ $subtotal }}</p>
  </div>
  <div class="d-flex justify-content-between">
   <p>Delivery Charge</p>
   <p>{{ __getPriceunit() }} {{ $charge }}</p>
  </div>

  <div class="d-flex justify-content-between">
   <p>Grand Total</p>
   <p>{{ __getPriceunit() }} {{ $subtotal+$charge }}</p>
  </div>
</div>
@endif
<hr>

<label for="prepaid" class="d-flex align-items-center justify-content-around payment"  style="margin-right: 5.7rem;">
  <input id="prepaid" type="radio" value="prepaid" name="payment_type"    required/>
  <img src="{{ asset('razor.png') }}" alt="razor pay" class="img-fluid" style="width:100px">
</label>

<label for="cod" class="d-flex align-items-center justify-content-around mt-1 payment" style="margin-right: 5.7rem;">
  <input id="cod" type="radio" value="cod" name="payment_type"    required/>
  <img src="{{ asset('cod.png') }}" alt=" payment method" class="img-fluid" style="width:100px"/>
</label>
<hr>
<input type="submit" class="btn custom-bg-secondary text-white btn-block d-block w-100" value="Checkout" >



      </div>
    </div>
  </div>
  {{-- main row end --}}
</form>

</div>



    @endsection
   @push('scripts')
   

   <script>
$('#is_same').click(function(){
  if($(this).prop("checked") == true){
    $('#bname').val($('#name').val());
$('#bemail').val($('#email').val());
$('#bphone').val($('#phone').val());
$('#bstate').val($('#state').val());
$('#bdistrict').val($('#district').val());
$('#bcity').val($('#city').val());
$('#baddress').val($('#address').val());
$('#bzip_code').val($('#zip_code').val());
$('#bgst').val($('#gst').val());
            }
            else if($(this).prop("checked") == false){
   $('#bname').val('')
   $('#bemail').val('')
   $('#bphone').val('')
   $('#bstate').val('')
   $('#bdistrict').val('')
   $('#bcity').val('')
   $('#baddress').val('');
  $('#bzip_code').val('')
  $('#bgst').val('')
          }



})
   </script>

   <script>
       $('document').ready(function(){

$('#form').click(function(event){
  total=$('#total').val();
  vat=$('#vat').val();
  charge=$('#charge').val();
  cart=$('#cart_value').val();
  fname=$('#fname').val();
  lname=$('#lname').val();
  zip=$('#zip').val();
  state=$('#state').val();
  city=$('#city').val();
  phone=$('#phone').val();
  email=$('#email').val();
  payment=$('#payment').val();
  pid=$('#pid').val();
  buynow=$('#buynow').val();



  let _token   = $('meta[name="csrf-token"]').attr('content');
  
  $.ajax({//aax call
  url:'{{ url('esewa/payment/')}}',
  type:"POST",
  data:{
    total:total,
    vat:vat,
    charge:charge,
    cart:cart,
    fname:fname,
    lname:lname,
    zip:zip,
    pid:pid,
    buynow:buynow,
    state:state,
    city:city,
    phone:phone,
    email:email,
    payment:payment,
_token:_token
    
    },
success:function(data){
console.log(data)
}

})


})
        
       })
      
   </script>

   @endpush