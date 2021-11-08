@extends('admin.master')
@php
       define('PAGE','levelprice')
@endphp
@section('main-content')
<div class="container-fluid p-0">


            <div class="card">
                    <h3 class=" mb-0">Update Repurchase Topup comission</h3>
                <div class="card-body">
                    <form action="{{route('admin.repurchasetopup.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$level->id}}">
                        <div class="form-group">
                            <label for="">Level {{$level->level}}</label>
                            <input type="text" class="form-control" name="percent" value="{{ $level->percent }}">
                        </div>
                      
                        <br>
                        <input type="submit" value="save" class="form-control">
                    </form>



                </div>
            </div>
        </div>

                @endsection
