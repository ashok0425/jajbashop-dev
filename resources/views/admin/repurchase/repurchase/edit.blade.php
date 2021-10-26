@extends('admin.master')
@php
       define('PAGE','levelprice')
@endphp
@section('main-content')
<div class="container-fluid p-0">


            <div class="card">
                    <h3 class=" mb-0">update Level Repurchase</h3>
                <div class="card-body">
                    <form action="{{route('admin.repurchase.comission.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$level->id}}">
                        <div class="form-group">
                            <label for="">Min Bv</label>
                            <input type="text" class="form-control" name="min_bv" value="{{ $level->min_bv }}">
                        </div>
                        <div class="form-group">
                            <label for="">Max Bv</label>
                            <input type="text" class="form-control" name="max_bv" value="{{ $level->max_bv }}">
                        </div>
                        <div class="form-group">
                            <label for="">Comission Percent</label>
                            <input type="text" class="form-control" name="percent" value="{{ $level->percent }}">
                        </div>
                        <br>
                        <input type="submit" value="save" class="form-control">
                    </form>



                </div>
            </div>
        </div>

                @endsection
