@push('style')
   
<style>
  div#lightboxed--thumbs{
    top:70%!important;
  }
  div#lightboxed--bttn_close{
    background-image:url({{ asset('controls.png') }})!important;
  }
  div#lightboxed--bttn_prev{
    background-image:url({{ asset('controls.png') }})!important;

  }
  div#lightboxed--bttn_next{
    background-image:url({{ asset('controls.png') }})!important;

  }
 .main_image{
max-width: 400px!important;
}

.size:checked ~ label{
  outline: 2px solid rgb(114, 114, 114)!important;


}
.color-label{
  width: 35px;
  height: 25px;

}



#gallery_01 img{border:2px solid white;}

 /*Change the colour*/
 /* .active img{border:2px solid #333 !important;} */
.max{
  max-width: 800px!important;
}
 .col_img{

 z-index:-1;
 visibility: hidden;
}
.lightboxed--caption{
  display: none!important;
}
.detail img{
  max-width: 60%!important;
  margin: auto!important;
}
</style>
<link rel="stylesheet" href="{{ asset('frontend/lightboxed.css') }}">
@endpush
@extends('frontend.master')

@section('content')
<!-- ? PAGE CONTENT -->
<section class="bg-white pt-4">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-5 my-2 col-md-5">
              <div class="row">
                  <div class="col-2 d-none d-md-block">
                    <div id="gal1" >
                   
                   
                    @if ($product->image)
                        <a href="#" data-image="{{__getimagePath($product->image) }}" data-zoom-image="{{__getimagePath($product->large_image) }}" >
                          <img id="img_01" src="{{__getimagePath($product->image) }}" class="img-fluser_id mb-0" style="max-width:50px;max-height:50px;margin:auto;"/>
                         <!--<br> <small class="mb-5">Thumbnail </small>-->
                        </a>
                      <p></p>

                        @endif
                        @if ($product->front)
                        <a href="#" data-image="{{__getimagePath($product->front) }}" data-zoom-image="{{__getimagePath($product->large_front) }}" >
                          <img id="img_01" src="{{__getimagePath($product->front) }}" class="img-fluser_id mb-0" style="max-width:50px;max-height:50px;margin:auto;"/>
                         <!--<br> <small class="mb-5">Front view</small>-->
                        </a>
                        
                        <p></p>
                        @endif

                        @if ($product->back)
                        <a href="#" data-image="{{__getimagePath($product->back) }}" data-zoom-image="{{__getimagePath($product->large_back) }}" >
                          <img id="img_01" src="{{__getimagePath($product->back) }}" class="img-fluser_id mb-0" style="max-width:50px;max-height:50px;margin:auto;"/>
                       <!--<br> <small class="mb-5">-->
                       <!--   Back view-->
                       <!-- </small>-->
                        </a>
                        <p></p>
                        @endif
                        @if ($product->left)
                        <a href="#" data-image="{{__getimagePath($product->left) }}" data-zoom-image="{{__getimagePath($product->large_left) }}" >
                          <img id="img_01" src="{{__getimagePath($product->left) }}" class="img-fluser_id mb-0 text-center mx-auto" style="max-width:50px;max-height:50px;margin:auto;"/>
                        <!--<br> <small class="mb-5">-->
                        <!--    Left view-->
                        <!--  </small>-->
                        </a>
                        <p></p>
                        @endif

                        @if ($product->right)
                        <a href="#" data-image="{{__getimagePath($product->right) }}" data-zoom-image="{{__getimagePath($product->large_right) }}" >
                          <img id="img_01" src="{{__getimagePath($product->right) }}" class="img-fluser_id mb-0"style="max-width:50px;max-height:50px;margin:auto;"/>
                        <!--<br> <small class="mb-5">-->
                        <!--  Right View-->
                        <!-- </small>-->
                        </a>
                        <p></p>
                        @endif


                              
                        @if ($product->video)
                        <a href="#" data-image="{{__getimagePath($product->video) }}" data-zoom-image="{{__getimagePath($product->video) }}" >
                          <img class="lightboxed  img-fluid" rel="group1" src="{{ asset('frontend/download.png') }}" data-link="{{ __getimagePath($product->video) }}" />
                        </a>
                    
                        @endif

                  </div>
                </div>

                  <div class="col-md-0 col-10 col-sm-8 d-none d-md-block">
              
        
 
                    <img id="zoom_01" src='{{__getimagePath($product->image) }}' data-zoom-image="{{__getimagePath($product->large_image) }}"  class="main_image img-fluid " />

              

                  </div>
<div class="col-md-6 offset-md-3 mt-4 d-none d-md-block">
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="addthis_inline_share_toolbox"></div>
            
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6159504520ba707c"></script>
</div>
            
                  <div class="col-md-12 col-12 col-sm-12 d-md-none d-inline">
                    <img class="lightboxed img-fluid w-100  d-md-none d-inline" rel="group1" src="{{__getimagePath($product->image) }}" data-link="{{__getimagePath($product->image) }}" alt="Image Alt" data-caption="Image Caption" />

            <div class="row  mt-1">
              @if ($product->front)
              <div class="col-2">
                <img class="lightboxed img-fluid" rel="group1" src="{{__getimagePath($product->front) }}" data-link="{{__getimagePath($product->front) }}" alt="Image Alt" data-caption="Image Caption" />
              </div>
              @endif

              @if ($product->back)
              <div class="col-2">
              <img class="lightboxed img-fluid" rel="group1" src="{{__getimagePath($product->back) }}" data-link="{{__getimagePath($product->back) }}"  />
              </div>
              @endif

              @if ($product->left)
              <div class="col-2">
              <img class="lightboxed img-fluid" rel="group1" src="{{__getimagePath($product->left) }}" data-link="{{__getimagePath($product->left) }}"  />
              </div>
              @endif

              @if ($product->right)
              <div class="col-2">
              <img class="lightboxed img-fluid" rel="group1" src="{{__getimagePath($product->right) }}" data-link="{{__getimagePath($product->right) }}" alt="Image Alt" data-caption="Image Caption" />
              </div>
              @endif

              @if ($product->video)
              <div class="col-2">          
                <a href="#" data-image="{{__getimagePath($product->video) }}" data-zoom-image="{{__getimagePath($product->video) }}" >
                  <img class="lightboxed img-fluid" rel="group1" src="{{ asset('frontend/download.png') }}" data-link="{{ __getimagePath($product->video) }}" />
                </a>
                <p>Video</p>
            </div>
            @endif
            <div class="col-md-6 offset-md-3 my-1 d-block d-md-none">
              <!-- Go to www.addthis.com/dashboard to customize your tools -->
              <div class="addthis_inline_share_toolbox"></div>
                      
              <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6159504520ba707c"></script>
          </div>
          </div>
        </div>
      </div>

        </div>
      


          <div class="col-lg-7 my-2 col-md-7">
            <p class="my-0 py-0 d-none d-md-block custom-fs-15">
              {{ Str::limit($product->short_desc ,200)}}

            </p>
            
             
              
              <div class="row">
                <div class="col-12">
                  <h1 class="custom-fs-20 custom-fw-600 mt-1">{{ $product->name }}</h1>
                  {{-- {{ route('seller',['id'=>$product->vendor_id,'name'=>$product->display_name]) }} --}}
                  <a class="custom-text-blue text-decoration-none custom-fw-500 custom-fs-10 my-0 mt-1 d-none d-md-block">Sold By : {{ $product->display_name }}</a>
                  </div>
                  {{-- add to wishlist  --}}
                  <div class="col-6 d-block d-md-none">
                    <a href="{{ route('wishlist.store',['id'=>$product->id]) }}" ><i class="far fa-heart shadow fa-2x custom-text-primary p-1"></i></a> 
           </div>

           <div class="col-12 d-block d-md-none">
            {{-- {{ route('seller',['id'=>$product->vendor_id,'name'=>$product->display_name]) }} --}}
            <a  class="custom-text-blue text-decoration-none custom-fw-500 custom-fs-10 my-0 mt-1 ">Sold By : {{ $product->display_name }}</a>
           </div>
          </div>

              <div class="row mt-4">
                {{-- review rating ahow & go to rating section --}}
                  <div class="col-12 col-md-6">
                    <a  class="text-decoration-none custom-text-blue custom-fs-15 custom-fw-500 go_to_review"   href="#tab" >
                    @if ($rating)
                      
                         @for ($i = 0; $i < number_format($rating,0); $i++)
                        <span class=" custom-text-orange custom-fs-20">
                         <i class="fas fa-star"></i>
                         </span>
                      @endfor 
                      @for ($i = 0; $i < 5-number_format($rating,0); $i++)
                        <span class="custom-fs-20 ">
                         <i class="fas fa-star custom-text-blue"></i>
                         </span>
                          
                      @endfor
                      @else    

                      Be the first to rate this product

                    @endif
                  </a>
                  </div>
                {{--XX review rating ahow & go to rating section XX--}}


                {{-- add to wishlist  --}}
                  <div class="col-3 d-none d-md-block ">
                           <a href="{{ route('wishlist.store',['id'=>$product->id]) }}" ><i class="far fa-heart shadow fa-2x custom-text-primary p-1"></i></a> 
                  </div>



              <hr class="mt-3">
                <div class="row">
                
                  {{-- price sction  --}}
               @if ($first)
                     <div class="col-12 col-md-6 col-lg-4 ">
                        @if (isset($first->offer_price))
                        <h2 class="custom-text-black custom-fs-15">M.R.P:- <s>{{ __getPriceunit() }} <span class="custom-fs-20">
                          {{$first->price}}
                        </span>
                      </s>
                      </h2>
                        @endif
                          <h2 class="custom-text-black custom-fs-15">                            
                            Price:- 
                            {{ __getPriceunit() }}
                            <span class="price custom-fs-20">

                            @if (isset($first->offer_price))
                            <span class="custom-fs-20"> {{ $first->offer_price }}</span>
                            @else   
                            <span class="custom-fs-20"> 
                             {{ $first->price }}
                           
                            </span>

                            @endif
                          </span>
                          </h2>
                     </div>
                                 {{-- Discount price amount in percent sction  --}}

                      <div class="col-12 col-md-6 col-lg-4">
                        @if (isset($first->offer_price))
                        <h3 class="custom-text-black custom-fs-20">You Save :
                          @php
                              $dicount=$first->price-$first->offer_price;
                              $p=($dicount*100)/$first->price;
                          @endphp
                          {{ number_format($p,1) }}%</h3>

                        @else   
                       

                        @endif
                          <p class="custom-text-black custom-fs-10">Inclusive of all taxes</p>
                      </div>

               @else 
                      <div class="col-12 col-md-6 col-lg-4 ">
                        @if (isset($product->offer_price))
                        <h2 class="custom-text-black custom-fs-15">M.R.P:-
                          <s> {{ __getPriceunit() }} <span class="custom-fs-20">
                          {{$product->price}}
                       
                        </span>
                      </s>
                      </h2>
                        @endif
                          <h2 class="custom-text-black custom-fs-15">
                            Price:- 
                            {{ __getPriceunit() }}
                            <span class="price custom-fs-20">

                            @if (isset($product->offer_price))
                            <span class="custom-fs-20"> {{ $product->offer_price }}</span>
                            @else   
                            <span class="custom-fs-20"> {{ $product->price }}</span>

                            @endif
                          </span>
                          </h2>
                      </div>
                             {{-- Discount price amount in percent sction  --}}

                             <div class="col-12 col-md-6 col-lg-4">
                              @if (isset($product->offer_price))
                              <h3 class="custom-text-black custom-fs-20">You Save :
                                @php
                                    $dicount=$product->price-$product->offer_price;
                                    $p=($dicount*100)/$product->price;
                                @endphp
                                {{ number_format($p,1) }}%</h3>
      
                              @else   
                             
      
                              @endif
                                <p class="custom-text-black custom-fs-10">Inclusive of all taxes</p>
                            </div>
      
                      @endif

           
                     {{-- stock   --}}
                      <div class="col-12 col-md-6 col-lg-4">
                          <h3 class="custom-fs-20 custom-fw-700">Availability: 
                            <span class="custom-fw-500">
                              @if ($product->qty>0)
                                  <div class="badge bg-success">Available</div>
                                  @else  
                                  <div class="badge bg-danger">Out Of Stock</div>

                              @endif
                            </span></h3>
                      </div>

                      <div class="col-12 col-md-6 col-lg-6 ">
                        
                          <span class="custom-fw-500">
                            @if ($product->delivery_charge<=0)
                            <h3 class="custom-fs-15 custom-fw-600">
                              Free Delivery
                          </span>
                                @else  
                                <h3 class="custom-fs-15 custom-fw-600">Delivery Charge: 
                            <small>{{ __getPriceunit() }}</small>
                               {{ $product->delivery_charge }}
                              </h3>
                            @endif
                          </span>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6">
                      <h3 class="custom-fs-15 custom-fw-600">Delivery Time: 
                        <span class="custom-fw-500">
                         
                              {{ $product->delivery_time }}
                             
                        </span></h3>
                  </div>
                  </div>

<form action="{{ route('cart.store') }}" method="GET">
  <input type="hidden" name="pid" value="{{ $product->id }}">
              <div class="row">

                {{-- product variatio like different size section --}}
              <div class="col-md-6 col-12 my-2 my-md-0">
                  @if (count($variation)>0)
           <h3 class="custom-fs-20 custom-fw-700 custom-text-black">Size</h3>

          @foreach ($variation as $item)
      <span>
     
        <input id="{{ $item->size }}" type="radio" value="{{ $item->id }}" name="size" class="size d-none"  @if ($loop->first)
        checked="checked"
        @endif  data-id="{{ $item->id }}"/>
        <label for="{{ $item->size }}" class="  border px-3 py-1 mx-1">
          {{ $item->size }}
      </label>
      </span>

          @endforeach
     
         @endif
              </div>


                {{-- product Colour like different color section --}}

         <div class="col-md-6 col-12 my-2 my-md-0">
         @if (count($color)>0)
         <h3 class="custom-fs-20 custom-fw-700 custom-text-black">Color</h3>
         <div id="gal1" >
          <input type="radio" value="" name="color" class="color d-none"  />

        @foreach ($color as $item)
      <label  class=" color-label  mx-1" style="background: {{ $item->color }}">
        <a href="#" data-image="{{asset($item->image) }}" data-zoom-image="{{asset($item->large_image) }}" class="color_img" data-text='{{$item->id}}'>
          <img id="img_01 " src="{{asset($item->image) }}" class="img-fluid col_img " />


        </a>
    </label>
        @endforeach
       @endif
              </div>
            </div>



            </div>

              <hr class="mt-2">
              <div>
                  <h3 class="custom-fs-20 custom-fw-700 custom-text-black">Quantity</h3>
                  <div class="row">
                      <div class="col-12 col-lg-4 col-md-4 my-2 ">
                        <div class="qty  d-flex  ">
                          <button  class="incrementbtn px-3    qtys"  type="button" data-input="demoInput{{ $product->id }}" data-id="{{ $product->id }}"   >+</button>
                          <input id="demoInput{{ $product->id }}" type="number" readonly value="1" class="value text-center" name="qty"  min="1" max="{{ $product->qty }}">
                          <button  class="decrementbtn   px-3 qtys"  type="button" data-input="demoInput{{ $product->id }}" data-id="{{ $product->id }}"  >-</button>
                        </div>
                      </div>

                      <div class="col-6 col-lg-4 col-md-4 my-2">
                          <button
                              class="btn border-0 custom-bg-primary p-0 custom-br-0 d-flex align-items-center add_to_cart @if ($product->qty<=0)
                              d-none
                                
                              @endif" value="0" name="type"  >
                              <span class="custom-bg-blue p-2">
                                 <i class="fas fa-shopping-cart text-white"></i>
                              </span>
                              <span class="custom-text-white p-2 custom-fs-15 custom-fw-500 px-3 pe-4">Add to
                                  Cart</span>
                          </button>
                      </div>
                      <div class="col-6 col-lg-4 col-md-4 my-2">
                          <button
                              class="btn border-0 custom-bg-blue p-0 custom-br-0 d-flex align-items-center add_to_cart @if ($product->qty<=0)
                              d-none
                                
                              @endif" value="1" name="type">
                              <span class="custom-bg-primary p-2">
                                <i class="fas fa-arrow-right text-white"></i>


                              </span>
                              <span class="custom-text-white p-2 custom-fs-15 custom-fw-500 px-3 pe-4">Buy
                                  Now</span>
                          </button>
                      </div>
                  </div>
                </form>
              </div>
          
          </div>
          
      </div>
  </div>


{{-- Tabs for different section  --}}



</div>

</section>
<div class="container">
{{-- <hr > --}}
  
  <div class="row">
    <div class="tab" id="tab">
      <button class="tablinks custom-bg-orange"  data-id="{{ $product->id }}" data-load="1">Description</button>
      <button class="tablinks" data-id="{{ $product->id }}" data-load="2">Terms & Conditions</button>
      <button class="tablinks" data-id="{{ $product->id }}" data-load="4">Seller  Information</button>
      <button class="tablinks" data-id="{{ $product->id }}" data-load="3">Product Reviews</button>
      <button class="tablinks" data-id="{{ $product->id }}" data-load="5">Q&A</button>

    
    
    </div>

    <!-- Tab content -->
<div class="  mb-5 " >
<div class="row">
  <div class="col-md-12  bg-white detail shadow">

  </div>
</div>
</div>
  </div>


 
</div>
 {{-- More product section  --}}
 {{-- @include('frontend.template.moreproduct') --}}
@endsection

@push('scripts')
<script src="{{ asset('frontend/lightboxed.js') }}"></script>
<script>

$("#zoom_01").elevateZoom({

gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true
});

//pass the images to Fancybox
$("#zoom_01").bind("click", function(e) {
var ez =   $('#zoom_01').data('elevateZoom');
  $.fancybox(ez.getGalleryList());
return false;
});

// tabs 

loadproductDetail(1,{{  $product->id }})
$('.tablinks').click(function(){
  $(this).addClass('custom-bg-orange')
  $(this).siblings().removeClass('custom-bg-orange')

  let load=$(this).data('load');
  let id=$(this).data('id');
  loadproductDetail(load,id)
})

// {{-- Load product conent on the basis of tab --}}

function loadproductDetail(load,id){
 
  $.ajax({
    url:'{{ url('loadproduct-detail')}}/'+load+'/'+id,
    dataType:'html',
    type:'GET',
    beforeSend:function(){
        $(".detail").html("<div class='d-flex justify-content-center py-5'><div class='spinner-border custom-text-primary text-center ' role='status'></div></div>");


	},
			 success:function(data){
		$(".detail").html(data);
         

  },

})

}

// go to review section on click to star above 
$('.go_to_review').on('click',function(e){
  loadproductDetail(3,{{ $product->id }})

})

    $(document).on('click','.size',function(){
        $('.value').val(1);
      let id=$(this).val();
     
      $.ajax({
        url:'{{ url('loadprice') }}/'+id,
        type:'GET',
        DataType:'Json',

        success:function(data){

          $('.price').html(data.price);
          $('.value').attr('max',data.qty);
          if(data.qty>=1){
            $('.add_to_cart').removeClass('d-none');
            $('.add_to_cart').addClass('d-inline');

          }else{
            $('.add_to_cart').addClass('d-none');
            $('.add_to_cart').removerClass('d-inline');
          }


        },

      })
    })





    // making border in selected color 
    $('.color_img').on('click',function(){
$(this).parent('.color-label').siblings().css('outline','0px solid transparent');
$(this).parent('.color-label').css('outline','3px solid rgb(114, 114, 114)');
$id=$(this).data('text');
$(".color").val($id);
    })




    function moreProductSlider() {
    moreProductSlider = new Glide("#more-product-slider", {
      type: "carousel",
      perView: 6,
      gap: 5,
      startAt: 0,
      autoplay: 6000,
      breakpoints: {
          1200: {
              perView: 5,
            },
            992: {
              perView: 4,
            },
            768: {
              perView: 3,
            },
            576: {
              perView: 2,
            },
            420: {
              perView: 2,
            },
          }
    });
    moreProductSlider.mount();
  }
moreProductSlider();
    </script>

@endpush