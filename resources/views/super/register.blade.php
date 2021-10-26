@extends('super.master')
@section('main-content')

@php
    define('PAGE','register')
@endphp
<div class="container-fluid mt-4">

    <div class="row">

        <div class="col-sm-12">
            <div class="card">

                <h3>Register New Distributor/Dealer</h3>
                <div class="card-body py-5 px-5" >

           <x-errormsg/>
@if (session()->has('register'))
    <div class="alert alert-success" role="alert">
        <p class="py-3 px-5">{{session()->get('register')}}</p>
    </div>
@endif


          <form action="{{route('super.distributor.store')}}" method="POST">
                    @csrf
                <div class="row">

                    

                    <div class="col-md-6 my-2">
                        <label >Full Name<span class="text-danger">*</span>
</label>
                        <input type="text" name="name" class="form-control" required value="{{old('name')}}">
                    </div>
                    <div class="col-md-6 my-2">
                        <label >Email<span class="text-danger">*</span>
</label>

                        <input type="email" name="email" class="form-control" required value="{{old('email')}}">
                    </div>
                    <div class="col-md-6 my-2">
                        <label >Phone Number<span class="text-danger">*</span>
</label>
<div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">+91</span>
    </div>
   <input type="tel" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="phone" value="{{old('phone')}}" maxlength='10'>
  </div>
                    </div>

                    <div class="col-md-6 my-2">
                        <label >Adhar No
</label>

                        <input type="tel" name="adhar" class="form-control" value="{{old('adhar')}}" maxlength='12'>
                    </div>

   <div class="col-md-6 my-2">
                                    <label >State<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="state" class="form-control"   value="{{old('state')}}">
                                </div>

                                <div class="col-md-6 my-2">
                                    <label >District<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="district" class="form-control"   value="{{old('district')}}">
                                </div>

                                <div class="col-md-6 my-2">
                                    <label >City<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="city" class="form-control"   value="{{old('city')}}">
                                </div>


                                <div class="col-md-6 my-2">
                                    <label >Address<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="address" class="form-control"   value="{{old('address')}}">
                                </div>

                                <div class="col-md-6 my-2">
                                    <label >Pincode<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="pincode" class="form-control"   value="{{old('pincode')}}">
                                </div>


                    <div class="col-md-6 my-2">
                        <label >Super Distributor Email<span class="text-danger">*</span>
</label>

                        <input type="text" name="sponsor_id" class="form-control" required value="{{__getSuper()->email}}">
                    </div>
                    <div class="col-md-12">
<input type="submit" class="form-control" value="Register">
                    </div>
                </div>

                </form>
                </div>
            </div>
        </div>




</div>
</div>

@endsection








