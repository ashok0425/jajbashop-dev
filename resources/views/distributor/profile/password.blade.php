@extends('distributor.master')

@php
       define('PAGE','profile')
@endphp
@section('main-content')
<div class="container-fluid p-0">

            <div class="card">


                    <h3 class=" mb-0 mt-0 pt-0">Change Password</h3>
                <div class="card-body">

                    <form action="{{route('super.password')}}" method="POST">
                        @csrf
                        <div class="form-group mt-2">

                            <label for="">Current password</label>
                            <input type="password" value="" class="form-control" name="currentpassword" required>

                        </div>
                        <div class="form-group mt-2">

                            <label for="">New password</label>
                            <input type="password" value="" class="form-control" name="newpassword" required>

                        </div>
                        <div class="form-group mt-2">

                            <label for="">Confirm password</label>
                            <input type="password" value="" class="form-control" name="confirmpassword" required>

                        </div>
                        <div class="form-group mt-2">
                        <input type="submit" value="save" class="form-control btn btn-primary">
                        </div>
                    </form>


                </div>
            </div>
        </div>

@endsection
