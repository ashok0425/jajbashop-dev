@extends('admin.master')
@php
       define('PAGE','profile')
@endphp
@section('main-content')
<div class="container-fluid p-0">


            <div class="card">
                    <h3 class=" mb-0">Update profile</h3>
                <div class="card-body">
                    <img src="@if(__getAdmin()->profile_photo_path==null)  {{asset('frontend/download.webp') }}    @else  {{asset(Auth::user()->profile_photo_path)}} @endif" alt="{{Auth::user()->profile_photo_path}}" width="100" height="100" class="rounded-circle image">
                    <img src=""  width="100" height="100" class="image-preview rounded-circle">
                    <h4 class=" mb-2 mt-1">{{__getAdmin()->name}}</h4>

                    <form action="{{route('admin.profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div class="image-input">
                                <input type="file" accept="image/*" id="imageInput" name="file">
                                <label for="imageInput" class="image-button"><i class="far fa-image"></i> Upload Profile Picture </label>


                              </div>
                        </div>
                        <div class="form- mt-2">
                            <input type="text" value="{{__getAdmin()->name}}" class="form-control" name="name" required>

                        </div>
                        <div class="form-group mt-2">
                            <input type="email" value="{{__getAdmin()->email}}" class="form-control" name="email" required>

                        </div>
                        <div class="form-group mt-2">

                        <input type="text" value="updated at: {{carbon\carbon::parse(__getAdmin()->updated_at)->diffForHumans()}}" class="form-control" readonly>
                        </div>
                        <div class="form-group mt-2">
                        <input type="submit" value="save" class="form-control ">
                        </div>
                    </form>


                </div>
            </div>
        </div>

                @endsection
