

@extends('frontend.master')
@section('content')
@if (count($compare)>0)
    <div class="container my-5">
      @foreach ($compare as $item)
      @php
      $name=DB::table('products')->where('id',$item->product_id)->value('name');

          $product=DB::table('products')->where('name','LIKE',"%$name%")->get();
      @endphp
      <div class="row row-sm my-5">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
             <h4> {{ $name }}</h4>
             <a href="{{ route('compare.remove',['id'=>$item->id]) }}"><i class="fas fa-times text-danger fa-2x" title="Remove from compare list"></i></a>
            </div>
          </div>
        </div>
        @foreach ($product as $item)
        <div class="col-md-3 col-6 my-3">
          <div class="card">
            <a href="{{ route('product.detail',['id'=>$item->id,'slug'=>$item->slug]) }}">
    
              <img src="{{asset($item->image)}}" class="card-img-top custom-br-0"
                  alt="{{$item->name}}" />
              <div class="card-body custom-bg-primary pb-0">
                  <h3 class="p-0 m-0 custom-fs-15 custom-fw-600 custom-text-white">{{$item->name}}</h3>
      
                      <div class=" p-0 m-0 mt-2 custom-fs-15 custom-fw-600 custom-text-white d-flex justify-content-between align-items-center"><span>{{__getPriceunit()}}
                  <s>{{$item->price}}</s>  </span><span>Price {{$item->offer_price}}</span></div>
              </div>
            </a>
              <div
                  class="card-body custom-bg-primary d-flex align-items-center p-0 py-1 px-2 pb-3 justify-content-between">
                  <div>
                      <button
                          class="btn custom-bg-orange custom-fw-600 custom-text-white custom-fs-15 px-2 px-md-4 rounded-pill shadow-lg quickview" data-id="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#viewmodal" data-text="2">Buy
                          now</button>
                  </div>
                  <div>
                      <button class="btn quickview" data-id="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#viewmodal" data-text="1">
                          <i class="fas fa-cart-plus text-white"></i>
                      </button>
                  </div>
              </div>
          </div>
      </div>
        @endforeach
   
    </div> <!-- row.// -->
    
    
      @endforeach
    
    </div>
  @else      
  <div class="my-5"></div>
   <div class="container mb-5">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h5>Compare List</h5>
              </div>
              <div class="card-body cart">
                  <div class="col-sm-12 empty-cart-cls text-center"> <i class="fas fa-sync-alt fa-3x custom-text-secondary">

                  </i>
                      <h3><strong>Your Compare List is Empty</strong></h3>
                      <h4>Add something to your Compare List :)</h4> <a href="{{ route('/') }}" class="btn custom-bg-secondary text-white cart-btn-transform m-3" data-abc="true"><i class="fas fa-arrow-left"></i> continue shopping</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
   </div>
    @endif
    @endsection
   