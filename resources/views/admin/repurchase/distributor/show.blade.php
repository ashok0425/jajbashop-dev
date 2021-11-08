@extends('admin.master')
<style>
    .font-weight-bold{
        font-size:1.1rem;
    }
</style>
@section('main-content')

@php
    define('PAGE','distributor')
@endphp
<div class="container-fluid mt-4">

  <div class="card">
    <h3>
        Detail of Super Distributo:- {{$super->name}}
    </h3>

  </div>

      <div class="row">


        <div class="col-md-4">
<div class="card">
    <div class="card-header">
<h4>Detail's</h4>
    </div>
    <div class="card-body">
<p>
    Name: {{$super->name}}
</p>

<p>
    Phone: {{$super->phone}}
</p>
<p>
    Email: {{$super->email}}
</p>
<p>
    Adhar Card No: {{$super->adhar}}
</p>
<p>
    Address: {{$super->address}}
</p>

<p>
    City: {{$super->city}}
</p>
<p>
    District: {{$super->district}}
</p>
<p>
    State: {{$super->state}}
</p>

<p>
    Status:   @if (!empty($super->status))
    <span class="badge bg-success">Active</span>
    @else
    <span class="badge bg-danger">Inactive</span>

    @endif
</p>

<p>
    Registered On: {{carbon\carbon::parse($super->created_at)->format('d M Y')}}
</p>
    </div>
</div>
        </div>



      </div>
    <a href="{{route('admin.distributor')}}" class="btn btn-info">Back</a>

</div>
@endsection








