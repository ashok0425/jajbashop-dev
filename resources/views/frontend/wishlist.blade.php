@push('style')
<style>
  
    .btn-custom{
    background:#DC7633;
    color: #fff; 	
    }
    .btn-custom:hover{
    background:#E59866;
    color: #fff; 	
    }
    .color-group {
    width: 5%;
    float: left;
    display: inline-block;
    display: -webkit-inline-box;
    padding-top: 5px;
    }
    img{
    width: 35%;
    }
    .color-block {
    float: left;
    position: relative;
    width: 100%;
    margin: 1px;
    padding-bottom: 100%;
    }
  
   
    .effects{
    border: 1px solid #fff;
    background: #fff;
    color: #888f96;
    }
    .effects:hover{
    background: #f7f3f3;
    transition: .4s;
    color: #000;
    cursor: pointer;
    transform: scale(1.03);
    border: 1px solid #f7f3f3;
    border-radius: 8px;
    }
    @media(max-width: 768px){
    .effects{
    text-align: center;
    margin: 20px;
    }
   
  
    .pull-right{
    float: none;
    text-align: center;
    display: block;
    margin: 20px auto;
    }
    }
    @media (max-width: 576px){
    
    .effects{
    background: #e8e8e852;
    border-radius: 8px;
    margin: 10px;
    }
    .col-md-3 h4:nth-child(1){
    padding-top: 10px;
    font-size: 20px;
    }
   
    
    }
  </style>
@endpush

@extends('frontend.master')
@section('content')
@if (count($wish)>0)
<div class="container text-dark card mt-5 pb-2 mb-5 px-0 shadow-sm">
        <h3 class="custom-text-secondary custom-fw-700  card-header bg-gray">Your Wishlist  Item</h3>


      
    @foreach ($wish as $item)
    <div class="row py-3 ">
        <div class="col-md-3 offset-md-1">
          <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->name }}">
        </div>
        <div class="col-md-3">
          <h5>{{ $item->name }}</h5>
          <small>{{ $item->short_desc }}</small>
         
        </div>
        <div class="col-md-2">
            <h5>Price</h5>

            <h6>{{ __getPriceunit() }} {{ $item->price }}</h6>
       
          </div>
        <div class="col-md-2">
          <a href="{{ route('wishlist.cart',['id'=>$item->pid]) }}"><i class="fa fa-shopping-cart custom-text-secondary fa-2x mx-2"></i></a>

          <a href="{{ route('wishlist.remove',['id'=>$item->id]) }}"><i class="fa fa-trash text-danger fa-2x mx-2"></i></a>
        </div>
      </div> 
    @endforeach
    
    
  </div>
  @else      
  <div class="container pt-5 my-5">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h5>Wishlist</h5>
              </div>
              <div class="card-body cart">
                  <div class="col-sm-12 empty-cart-cls text-center"> <i class="fas fa-heart fa-3x custom-text-secondary">

                  </i>
                      <h3><strong>Your Wishlist is Empty</strong></h3>
                      <h4>Add something to your wishlist :)</h4> <a href="{{ route('/') }}" class="btn custom-bg-secondary text-white cart-btn-transform m-3" data-abc="true"><i class="fas fa-arrow-left"></i> continue shopping</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
  
  <div class="py-5 my-5"></div>
    @endif
    @endsection
   