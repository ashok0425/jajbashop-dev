@extends('member.master')

@php
       define('PAGE','deposite')
@endphp
@section('main-content')
<div class="container-fluid">


    <div class="row">


        <div class="col-md-12 col-xl-12">
<div class="card">
                    <h3 class=" mb-0">Deposite Request</h3>
           <x-errormsg/>

               <div class="card-body px-5">
<form action="{{route('member.deposite.request.store')}}" method="POST">
    @csrf
    <div class="form-group my-2">
        <label>Amount<span class="text-danger" >*</span></label>
        <input type="number" class="form-control" name="amount"  required >



    </div>
    <div class="form-group my-2">
        <label >Remark<span class="text-danger" >*</span></label>
        <textarea  class="form-control" name="remark" required>

        </textarea>
    </div>
    <div class="form-group my-2">


    <div class="image-input">
        <img src=""  width="100" height="100" class="image-preview">

        <input type="file" accept="image/*" id="imageInput" name="file" required>
        <label for="imageInput" class="image-button"><i class="far fa-image"></i> Upload  Picture </label>
    </div>


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
