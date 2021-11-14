@extends('member.master')
@section('main-content')

@php
    define('PAGE','member')
@endphp
<div class="container-fluid mt-4">

  <div class="card">
    <h3>
        Detail of user:- {{$member->userid}}
    </h3>

  </div>

      <div class="row">

        <div class="col-md-4">
<div class="card">
    <div class="card-header">
<h4>User Detail</h4>
    </div>
    <div class="card-body">
<p>
    Name: {{$member->name}}
</p>
<p>
    Username: {{$member->userid}}
</p>
<p>
    Phone: {{$member->phone}}
</p>

<p>
    Status:   @if (!empty($member->status))
    <span class="badge bg-success">Active</span>
    @else
    <span class="badge bg-danger">Inactive</span>

    @endif
</p>
<p>
   Sponsored By: {{$member->sponsor_id}}
</p>
<p>
    Registered On: {{carbon\carbon::parse($member->created_at)->format('d F Y')}}
</p>
    </div>
</div>
        </div>

<a href="{{route('member.all')}}" class="btn btn-info">Back</a>

</div>
@endsection








