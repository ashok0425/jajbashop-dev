@extends('member.master')

@php
       define('PAGE','pin')
@endphp
@section('main-content')
<div class="container-fluid">


    <div class="row">


        <div class="col-md-12 col-xl-12">
<div class="card">
                    <h3 class=" mb-0">Send Request Form E-pin</h3>
           <x-errormsg/>

               <div class="card-body px-5">
<form action="{{route('member.ticket.store')}}" method="POST">
    @csrf
    <div class="form-group my-2">
        <label >Title<span class="text-danger" >*</span></label>
        <textarea  class="form-control" name="title" required >
            For E-pin Transfer
        </textarea>

    </div>
    <div class="form-group my-2">
        <label >E-pin Qty (No of E-pin You want)<span class="text-danger" >*</span></label>
        <input type="number" class="form-control" name="number" value="1" required min="1">

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
