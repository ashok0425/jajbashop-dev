@extends('admin.master')
@php
       define('PAGE','pin')
@endphp
@section('main-content')
<div class="container-fluid">


    <div class="row">


        <div class="col-md-12 col-xl-12">
<div class="card">
                    <h3 class=" mb-0">Transfer E-pin</h3>
           <x-errormsg/>

               <div class="card-body px-5">
<form action="{{route('admin.epin.store')}}" method="POST">
    @csrf
    <div class="form-group my-2">
        <label >User Id <span class="text-danger" >*</span></label>
        <input type="text" class="form-control" name="user_id" required value="@if(isset($userid)) {{$userid}} @else
        {{old('user_id')}} @endif ">

    </div>
    <div class="form-group my-2">
        <label >E-pin No <span class="text-danger" >*</span></label>
        <input type="text" class="form-control" name="number" value="{{old('number')}}" required>

    </div>

    <div class="form-group my-2">
        <label >E-pin Package Type <span class="text-danger" >*</span></label>
<select name="package" id="" required class="form-control">
    <option value="">---select package type---</option>
    <option value="1">Package-1000</option>
    <option value="0">Package-650</option>

</select>
    </div>
    <div class="form-group mt-4">
        <input type="submit" class="form-control">

    </div>
</form>

               </div>

            </div>
        </div>
    </div>

</div>
@endsection
