@extends('frontend.master')
@section('content')
    
  

    <!-- Brand Section  -->
    @include('frontend.includes.banner1')
    
     <!-- Product Wrap  -->
     @include('frontend.includes.featured')

    <!-- Banner Section  -->
    @include('frontend.includes.banner2')
     
     <!-- Product Wrap  -->
     @include('frontend.includes.topoffer')

   <!-- Banners Section  -->
  @include('frontend.includes.banner3')

    <!-- Product Wrap  -->
    @include('frontend.includes.bestseller')
  
   
   
    @include('frontend.includes.banner4')

    <!-- Product Wrap  -->
    @include('frontend.includes.newarrival')
    

    <!-- Sponsored Section  -->
    @include('frontend.includes.brand')
    


    @include('frontend.includes.banner5')

    @endsection
