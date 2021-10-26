
@extends('admin.master')
@php
       define('PAGE','role')
@endphp
@section('main-content')



<div class="card">
        <h3>Add Role And Permisssion</h3>

    <div class="card-body">

        <form action="{{route('admin.role.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
     <div class="container">
         <div class="row">
             <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                </div>

             </div>
             <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}" required>
                </div>

             </div>
             <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" value="{{old('password')}}" required>
                </div>

             </div>
             <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="conpassword" value="{{old('conpasssword')}}" required class="form-control">
                </div>

             </div>
             <div class="col-md-12">
                 <h3>Manage Permission</h3>
             <div class="row">
                 <div class="col-md-4">
                    <div class="mb-3">
                        <label >
    <input type="checkbox" value="1" name="dashboard" id="">
    Dashboard
                        </label>

                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="mb-3">
                        <label >
    <input type="checkbox" value="1" name="role" id="">
    Role
                        </label>

                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="mb-3">
                        <label >
    <input type="checkbox" value="1" name="epin" id="">
 Epin
                        </label>

                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="mb-3">
                        <label >
    <input type="checkbox" value="1" name="user" id="">
   User      </label>

                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="mb-3">
                        <label >
    <input type="checkbox" value="1" name="levelprice" id="">
   Level Price
                        </label>

                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="mb-3">
                        <label >
    <input type="checkbox" value="1" name="kyc" id="">
   Kyc
                        </label>

                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="mb-3">
                        <label >
    <input type="checkbox" value="1" name="withdrawal" id="">
   Withdrawal
                        </label>

                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="mb-3">
                        <label >
    <input type="checkbox" value="1" name="deposite" id="">
    Deposite
                        </label>

                    </div>
                 </div>



                 <div class="col-md-4">
                    <div class="mb-3">
                        <label >
    <input type="checkbox" value="1" name="profile" id="" checked>
    Profile
                        </label>

                    </div>
                 </div>
             </div>

             </div>
         </div>
     </div>
<div class="d-flex">
    <button type="submit" class="btn btn-primary">Add</button>
    &nbsp;
    &nbsp;
    &nbsp;
<a href="{{route('admin.role')}}" class="btn btn-info">Back</a>
</div>
        </form>
    </div>

</div>
@endsection
