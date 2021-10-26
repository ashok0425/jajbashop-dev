@extends('admin.master')
@section('main-content')

@php
    define('PAGE','super')
@endphp
                <div class="container-fluid mt-4">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="card">

                                <h3>Update Super Distributor Data</h3>
                                <div class="card-body py-5 px-5" >

                        <x-errormsg/>
                @if (session()->has('register'))
                    <div class="alert alert-success" role="alert">
                        <p class="py-3 px-5">{{session()->get('register')}}</p>
                    </div>
                @endif
                        <form action="{{route('admin.super.update')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$user->id}}" name="id">
                                <div class="row">
                                    <div class="col-md-12 my-2">
                                        <label >Photo<span class="text-danger">*</span>
                </label>
                <br>
                                    <img src="{{asset($user->profile_photo_path)}}" alt="{{asset($user->profile_photo_path)}}" class="img-" width="100" height="100" style="border-radius: 50%">
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <label >Full Name<span class="text-danger">*</span>
                </label>
                                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <label >Email<span class="text-danger">*</span>
                </label>

                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                    </div>
                    <div class="col-md-6 my-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">+91</span>
                        </div>
                        <input type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="phone" value="{{$user->phone}}" >
                      </div>
                      </div>

                    <div class="col-md-6 my-2">
                        <label >Adhar No<span class="text-danger">*</span>
                    </label>

                        <input type="" name="adhar" class="form-control"  value="{{$user->adhar}}">
                    </div>

           

                    <div class="col-md-6 my-2">
                        <label >State<span class="text-danger">*</span>
                    </label>

                        <input type="text" name="state" class="form-control"   value="{{$user->state}}">
                    </div>

                    <div class="col-md-6 my-2">
                        <label >District<span class="text-danger">*</span>
                    </label>

                        <input type="text" name="district" class="form-control"   value="{{$user->district}}">
                    </div>

                    <div class="col-md-6 my-2">
                        <label >City<span class="text-danger">*</span>
                    </label>

                        <input type="text" name="city" class="form-control"   value="{{$user->city}}">
                    </div>


                    <div class="col-md-6 my-2">
                        <label >Address<span class="text-danger">*</span>
                    </label>

                                            <input type="text" name="address" class="form-control"   value="{{$user->address}}">
                                        </div>

                                        <div class="col-md-6 my-2">
                                            <label >Pincode<span class="text-danger">*</span>
                    </label>

                                            <input type="text" name="pincode" class="form-control"   value="{{$user->pincode}}">
                                        </div>

                    <div class="col-md-6 my-2">
                                            <label >Password (type only when you want to change password)<span class="text-danger">*</span>
                    </label>

                                            <input type="text" name="password" class="form-control"   value="">
                                        </div>

                                        <div class="col-md-12">
                    <input type="submit" class="form-control" value="Save">
                                        </div>
                                    </div>

                                    </form>
                                    </div>
                                </div>
                            </div>

                            <a href="{{route('admin.super')}}" class="btn btn-info">Back</a>



                    </div>
                    </div>

@endsection








