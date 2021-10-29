@extends('frontend.master')
@section('header')
<section class="section-pagetop bg_gray ">
    <div class="container">
        <h2 class="title-page">About us</h2>
    </div> <!-- container //  -->
    </section>
@endsection
@section('content')
@php
    $about=DB::table('pages')->first();
@endphp

<div class="container ">
<div class="m-md-5">
    {!! $about->about !!}

</div>
</div>

@endsection

