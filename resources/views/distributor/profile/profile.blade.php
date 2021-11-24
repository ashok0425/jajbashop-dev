@extends('distributor.master')

@php
       define('PAGE','profile')
@endphp
@section('main-content')
<div class="container-fluid p-0">


            <div class="card">
                    <h3 class=" mb-0">Update profile</h3>
                <div class="card-body">
                    <x-errormsg/>
                    <img src="@if(__getDist()->profile_photo_path==null)  {{asset('frontend/download.webp') }}    @else  {{asset(__getDist()->profile_photo_path)}} @endif" alt="{{__getDist()->profile_photo_path}}" width="100" height="100" class="rounded-circle image">
                    <img src=""  width="100" height="100" class="image-preview rounded-circle">
                    <h4 class=" mb-2 mt-1">{{__getDist()->name}}</h4>

                    <form action="{{route('distributor.profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div class="image-input">
                                <input type="file" accept="image/*" id="imageInput" name="file">
                                <label for="imageInput" class="image-button"><i class="far fa-image"></i> Upload Profile Picture </label>


                              </div>


                        </div>




                        <div class="container">
                            <div class="row">




                                <div class="col-md-6 my-2">
                                    <label >Full Name<span class="text-danger">*</span>
            </label>
                                    <input type="text" name="name" class="form-control" value="{{__getDist()->name}}" >
                                </div>
                                <div class="col-md-6 my-2">
                                    <label >Email<span class="text-danger">*</span>
            </label>

                                    <input type="email" name="email" class="form-control" value="{{__getDist()->email}}">
                                </div>
                                <div class="col-md-6 my-2">
                                    <label >Phone Number<span class="text-danger">*</span>
            </label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">+91</span>
                </div>
                <input type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="phone" value="{{__getDist()->phone}}" disabled>
              </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <label >Adhar No<span class="text-danger">*</span>
            </label>

                                    <input type="" name="adhar" class="form-control"  value="{{__getDist()->adhar}}" disabled>
                                </div>
                                {{-- <div class="col-md-6 my-2">
                                    <label >Sponser ID<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="sponsor" class="form-control"  disabled value="{{__getDist()->sponsor_id}}">
                                </div> --}}

                                <div class="col-md-6 my-2">
                                    <label >State<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="state" class="form-control"   value="{{__getDist()->state}}">
                                </div>

                                <div class="col-md-6 my-2">
                                    <label >District<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="district" class="form-control"   value="{{__getDist()->district}}">
                                </div>

                                <div class="col-md-6 my-2">
                                    <label >City<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="city" class="form-control"   value="{{__getDist()->city}}">
                                </div>


                                <div class="col-md-6 my-2">
                                    <label >Address<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="address" class="form-control"   value="{{__getDist()->address}}">
                                </div>

                                <div class="col-md-6 my-2">
                                    <label >Pincode<span class="text-danger">*</span>
            </label>

                                    <input type="text" name="pincode" class="form-control"   value="{{__getDist()->pincode}}">
                                </div>


                            </div>

                    </div>


                        <div class="form-group mt-2">
                        <input type="submit" value="save" class="form-control ">
                        </div>
                    </form>
                      {{-- <a href="{{route('super.idcard')}}" class="btn btn-danger btn-block mt-1"><i class="fa fa-print"></i> Print ID Card</a> --}}

                </div>
            </div>
        </div>

                @endsection
