@extends('frontend.master')
<style>
    .position_sticky{
        position: sticky!important;
        top: 50px;
    }
</style>
@section('header')
<section class="section-pagetop bg_gray ">
    <div class="container">
        <h2 class="title-page">Feature's Business</h2>
    </div> <!-- container //  -->
    </section>
@endsection
@section('content')
@php
    $about=DB::table('pages')->first();
@endphp    

<div class="container-fluid my-5 " >
<div class="row">
    <div class="col-md-3  ">
        <div class="card shadow-sm position_sticky ">

<div class="card-body ">
    <h5><a href="#dashboard" class="text-dark custom-fw-600 custom-fs-20"><i class="fas fa-arrow-right"></i> Dashoboard</a></h5>
<h5><a href="#whysell" class="text-dark custom-fw-600 custom-fs-20"><i class="fas fa-arrow-right"></i> Why sell on Baratodeal</a></h5>
<h5><a href="#faq" class="text-dark custom-fw-600 custom-fs-20"><i class="fas fa-arrow-right"></i> FAQ</a></h5>
<h5><a href="#lerningcenter" class="text-dark custom-fw-600 custom-fs-20"><i class="fas fa-arrow-right"></i> Learning Center</a></h5>
</div>

</div>

    </div>
    <div class="col-md-7  card shadow-sm offset-md-1">
<div class="card-body">
<div class="my-4" id="dashboard">
    {!! $about->dashboard !!}
</div>
<div class="my-4" id="whysell">
    {!! $about->why_sell !!}
</div>
<div class="my-4" id="faq">
    {!! $about->faq !!}
</div>
<div class="my-4" id="lerningcenter">
    {!! $about->learning_center !!}
</div>
</div>
    </div>
</div>
</div>


@endsection

