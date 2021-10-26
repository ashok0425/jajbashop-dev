@extends('admin.master')
@php
       define('PAGE','levelprice')
@endphp
@section('main-content')
<div class="container-fluid p-0">


            <div class="card">
                    <h3 class=" mb-0">update Level Price</h3>
                <div class="card-body">
                    <form action="{{route('admin.level.price.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$level->id}}">
                        <div class="form-group">
                            <label for="">Level {{$level->level}}</label>
                            <input type="text" class="form-control" name="price">
                        </div>
                        <div class="form-group">
                            <label for="">Package </label>
                            <input type="text" class="form-control" name="price" disabled value="@if ($level->package==1)
                            Pacakge1000
                        @elseif($level->package==0)
                        Pacakge650
                        @endif">
                        </div>
                        <br>
                        <input type="submit" value="save" class="form-control">
                    </form>



                </div>
            </div>
        </div>

                @endsection
