
@extends('admin.master')
@php
       define('PAGE','role')
@endphp
@section('main-content')



<div class="card">
        <h3>Edit Role And Permisssion</h3>

    <div class="card-body">

        <form action="{{route('admin.role.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $admin->id }}">
     <div class="container">
         <div class="row">
             <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$admin->name}}" required>
                </div>

             </div>
             <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{$admin->email}}" required>
                </div>

             </div>

             <div class="col-md-12">
                <h3>Manage Permission</h3>
            <div class="row">
                <div class="col-md-4">
                   <div class="mb-3">
                       <label >
   <input type="checkbox" value="1" name="dashboard" id="" @if ($admin->dashboard==1)
       checked
   @endif>
   Dashboard
                       </label>

                   </div>
                </div>
                <div class="col-md-4">
                   <div class="mb-3">
                       <label >
   <input type="checkbox" value="1" name="role" id=""  @if ($admin->role==1)
   checked
@endif>
   Role
                       </label>

                   </div>
                </div>
                <div class="col-md-4">
                   <div class="mb-3">
                       <label >
   <input type="checkbox" value="1" name="epin" id=""  @if ($admin->epin==1)
   checked
@endif>
Epin
                       </label>

                   </div>
                </div>
                <div class="col-md-4">
                   <div class="mb-3">
                       <label >
   <input type="checkbox" value="1" name="user" id=""  @if ($admin->user==1)
   checked
@endif>
  User      </label>

                   </div>
                </div>
                <div class="col-md-4">
                   <div class="mb-3">
                       <label >
   <input type="checkbox" value="1" name="levelprice" id=""  @if ($admin->levelprice==1)
   checked
@endif>
  Level Price
                       </label>

                   </div>
                </div>
                <div class="col-md-4">
                   <div class="mb-3">
                       <label >
   <input type="checkbox" value="1" name="kyc" id=""  @if ($admin->kyc==1)
   checked
@endif>
  Kyc
                       </label>

                   </div>
                </div>
                <div class="col-md-4">
                   <div class="mb-3">
                       <label >
   <input type="checkbox" value="1" name="withdrawal" id=""  @if ($admin->withdrawal==1)
   checked
@endif>
  Withdrawal
                       </label>

                   </div>
                </div>
                <div class="col-md-4">
                   <div class="mb-3">
                       <label >
   <input type="checkbox" value="1" name="deposite" id=""  @if ($admin->deposite==1)
   checked
@endif>
   Deposite
                       </label>

                   </div>
                </div>



                <div class="col-md-4">
                   <div class="mb-3">
                       <label >
   <input type="checkbox" value="1" name="profile" id=""   @if ($admin->profile==1)
   checked
@endif>
   Profile
                       </label>

                   </div>
                </div>
            </div>

            </div>
         </div>
     </div>
     <div class="d-flex">
        <button type="submit" class="btn btn-primary">update</button>

        &nbsp;
        &nbsp;
        &nbsp;
    <a href="{{route('admin.role')}}" class="btn btn-info">Back</a>
    </div>
        </form>
    </div>
</div>
@endsection
