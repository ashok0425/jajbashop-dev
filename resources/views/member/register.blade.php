@extends('member.master')
@section('main-content')

@php
    define('PAGE','register')
@endphp
<div class="container-fluid mt-4">

    <div class="row">

        <div class="col-sm-12">
            <div class="card">

                <h3>Register New Member</h3>
                <div class="card-body py-5 px-5" >

           <x-errormsg/>
@if (session()->has('register'))
    <div class="alert alert-success" role="alert">
        <p class="py-3 px-5">{{session()->get('register')}}</p>
    </div>
@endif
@if (Auth::user()->status==null)
<div class="alert bg-danger text-white font-weight-bold pt-3 pb-2 px-3">
<p>Your Account is not Active yet.Please Active your Account in order to register the member.</p>
</div>
          @endif

          <form action="{{route('member.register')}}" method="POST">
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
                        <label >Sponser ID<span class="text-danger">*</span>
</label>

                        <input type="text" name="sponsor" class="form-control" required value="{{old('sponsor')}}">
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








