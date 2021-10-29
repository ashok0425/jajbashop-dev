@push('style')
    
<style>
  .ui-slider .ui-slider-handle{
      height: 20px;
      width:  15px;
top: -10px;
  }
  input[type=number]{
    border-radius: 10px;
    padding: .5rem 0;
    width: 45%;
    border: none;
    outline: none;
margin-top: .3rem;;
    border: 2px solid var( --info);
    text-align: center;
  }
  input[type=button]{
    border-radius: 10px;
    padding: .5rem 0;
    border: none;
    outline: none;
margin-top: .3rem;;
    border: 2px solid var( --custom-blue));
    text-align: center;
    color: #fff;
    background: var( --custom-blue);
    width:90%;
  }

  input[type=checkbox]{
  width: 20px;
  height: 20px;

  }
#mySlider{
  height: 5px;
  background-color:var( --color-light-primary)!important;
  width:90%;
  margin:.8rem auto;
}
</style>
@endpush
@extends('frontend.master')
@section('content')
<div class="container-fluid ">
<div class="row py-5 px-md-2 px-0" >
	<aside class="col-md-2 bg-white shadow py-5 col-6 d-none d-md-block">
        <article class="filter-group mb-3">
            <h6 class="title">
                <a> Price Range </a>
            </h6>

                 <div id="mySlider" style=""></div>

                    <input type="number" name="" id="hidden_min" value="0" class="bg-white shadow"/>
                    <input type="number" name="" id="hidden_max" value="25000" class="bg-white shadow"/>
                    <input type="button" name="" id="apply" value="Apply" />



        </article>


       {{-- category --}}
   
           <article class="filter-group mb-3 ">
               <h6 class="title">
                   <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="collapse" data-bs-target="#category"> Catgeory </a>
               </h6>
               <div class="filter-content collapse show" id="category">
                   <div class="inner">
                       @foreach ($category as $item)

                       <label class="custom-control custom-checkbox d-flex align-items-center my-1">
                         <input type="checkbox"  class="custom-control-input selector category" value="{{ $item->id }}" @if (isset($id) && $item->id==$id)
                             checked
                         @endif>
                         <div class="custom-control-label custom-fs-14 ">&nbsp;&nbsp;{{ $item->category }}&nbsp;&nbsp;
                        
                              </div>
                       </label>
                       @endforeach


                   </div> <!-- inner.// -->
               </div>
           </article> <!-- filter-group .// -->


  {{-- subcategory --}}
   
  <article class="filter-group mb-3">
    <h6 class="title">
        <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="collapse" data-bs-target="#subcatgeory"> Sub catgeory </a>
    </h6>
    <div class="filter-content collapse show" id="subcatgeory">
        <div class="inner">
            @foreach ($subcategory as $item)

            <label class="custom-control custom-checkbox d-flex align-items-center my-1">
              <input type="checkbox"  class="custom-control-input selector subcategory" value="{{ $item->id }}">
              <div class="custom-control-label custom-fs-14 ">&nbsp;&nbsp;{{ $item->subcategory }}&nbsp;&nbsp;
             
                   </div>
            </label>
            @endforeach


        </div> <!-- inner.// -->
    </div>

</article> <!-- filter-group .// -->
                   {{-- Brand  --}}
           <article class="filter-group mb-3">
            <h6 class="title">
                <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="collapse" data-bs-target="#brand"> Brand </a>
            </h6>
            <div class="filter-content collapse show" id="brand">
                <div class="inner">
                    @foreach ($brand as $item)

                    <label class="custom-control custom-checkbox d-flex align-items-center my-1">
                      <input type="checkbox"  class="custom-control-input selector brand mr-1" value="{{ $item->brand }}">
                      <div class="custom-control-label custom-fs-14  ">&nbsp;&nbsp;{{ $item->brand }}&nbsp;&nbsp;
                      
                        </div>
                    </label>
                    @endforeach


                </div> <!-- inner.// -->
            </div>
        </article> <!-- filter-group .// -->


      </article> <!-- filter-group .// -->
      {{-- Ratting  --}}
<article class="filter-group mb-3">
<h6 class="title">
   <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="collapse" data-bs-target="#rating">Star Rating </a>
</h6>
<div class="filter-content collapse show" id="rating">
   <div class="inner">

       <label class="custom-control custom-checkbox d-flex align-items-center my-1">
         <input type="checkbox"  class="custom-control-input selector rating mr-1" value="5">
         <div class="custom-control-label custom-fs-15 ">&nbsp;&nbsp;
            <i class="fas fa-star custom-text-orange"></i> 
            <i class="fas fa-star custom-text-orange"></i><i class="fas fa-star custom-text-orange"></i>
            <i class="fas fa-star custom-text-orange"></i>
            <i class="fas fa-star custom-text-orange"></i>
         
           </div>
       </label>

       <label class="custom-control custom-checkbox d-flex align-items-center my-1">
        <input type="checkbox"  class="custom-control-input selector rating mr-1" value="4">
        <div class="custom-control-label custom-fs-15 ">&nbsp;&nbsp;
           <i class="fas fa-star custom-text-orange"></i> 
           <i class="fas fa-star custom-text-orange"></i>
           <i class="fas fa-star custom-text-orange"></i>
           <i class="fas fa-star custom-text-orange"></i>
           <i class="fas fa-star custom-text-gray"></i>
         
        
          </div>
      </label>

      <label class="custom-control custom-checkbox d-flex align-items-center my-1">
        <input type="checkbox"  class="custom-control-input selector rating mr-1" value="3">
        <div class="custom-control-label custom-fs-15 ">&nbsp;&nbsp;
           <i class="fas fa-star custom-text-orange"></i> 
           <i class="fas fa-star custom-text-orange"></i><i class="fas fa-star custom-text-orange"></i><i class="fas fa-star custom-text-gray"></i>
            <i class="fas fa-star custom-text-gray"></i>
         
        
          </div>
      </label>

      <label class="custom-control custom-checkbox d-flex align-items-center my-1">
        <input type="checkbox"  class="custom-control-input selector rating mr-1" value="2">
        <div class="custom-control-label custom-fs-15 ">&nbsp;&nbsp;
           <i class="fas fa-star custom-text-orange"></i> 
           <i class="fas fa-star custom-text-orange"></i><i class="fas fa-star  custom-text-gray"></i><i class="fas fa-star custom-text-gray "></i>
            <i class="fas fa-star  custom-text-gray"></i>
         &nbsp;&nbsp;
        
          </div>
      </label>

      <label class="custom-control custom-checkbox d-flex align-items-center my-1">
        <input type="checkbox"  class="custom-control-input selector rating mr-1" value="2">
        <div class="custom-control-label custom-fs-15 ">&nbsp;&nbsp;
           <i class="fas fa-star custom-text-orange"></i> 
           <i class="fas fa-star  custom-text-gray"></i><i class="fas fa-star custom-text-gray "></i><i class="fas fa-star  custom-text-gray"></i>
            <i class="fas fa-star  custom-text-gray"></i>
         &nbsp;&nbsp;
        
          </div>
      </label>

   </div> <!-- inner.// -->
</div>
</article> <!-- filter-group .// -->

</article> <!-- filter-group .// -->
{{-- Sizes  --}}
{{-- <article class="filter-group mb-3">
<h6 class="title">
<a href="#" class="dropdown-toggle text-dark" data-bs-toggle="collapse" data-bs-target="#brand"> Size's </a>
</h6>
<div class="filter-content collapse show" id="brand">
<div class="inner">
 @foreach ($size as $item)

 <label class="custom-control custom-checkbox d-flex align-items-center my-1">
   <input type="checkbox"  class="custom-control-input selector category mr-1" value="{{ $item->id }}">
   <div class="custom-control-label custom-fs-15 ">&nbsp;&nbsp;{{ $item->brand }}&nbsp;&nbsp;
   
     </div>
 </label>
 @endforeach


</div> <!-- inner.// -->
</div>
</article> <!-- filter-group .// --> --}}


	</aside> <!-- col.// -->
	<main class="col-md-9 col-12">


<header class="mb-3 ">
		<div class="row">
      <div class="col-md-4 ">
     

        <h2 class=" pl-md-5 custom-text-danger d-md-none d-block mb-2 custom-fw-700 "><span class="counts">Filter </h2>
    </div>
    <hr class="d-md-none">
 
        {{-- category --}}
   
        <article class="filter-group col-12 d-md-none">
          <h6 class="title">
              <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="collapse" data-bs-target="#category"> Catgeory </a>
          </h6>
          <div class="filter-content collapse " id="category">
              <div class="inner">
                  @foreach ($category as $item)

                  <label class="custom-control custom-checkbox d-flex align-items-center my-1">
                    <input type="checkbox"  class="custom-control-input selector category" value="{{ $item->id }}" @if (isset($id) && $item->id==$id)
                        checked
                    @endif>
                    <div class="custom-control-label custom-fs-15">&nbsp;&nbsp;{{ $item->category }}&nbsp;&nbsp;
                   
                         </div>
                  </label>
                  @endforeach


              </div> <!-- inner.// -->
          </div>
      </article> <!-- filter-group .// -->


{{-- subcategory --}}
<article class="filter-group d-md-none  col-12">
<h6 class="title">
   <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="collapse" data-bs-target="#subcatgeory"> Sub catgeory </a>
</h6>
<div class="filter-content collapse " id="subcatgeory">
   <div class="inner">
       @foreach ($subcategory as $item)

       <label class="custom-control custom-checkbox d-flex align-items-center my-1">
         <input type="checkbox"  class="custom-control-input selector subcategory" value="{{ $item->id }}">
         <div class="custom-control-label custom-fs-15">&nbsp;&nbsp;{{ $item->subcategory }}&nbsp;&nbsp;
        
              </div>
       </label>
       @endforeach


   </div> <!-- inner.// -->
</div>

</article> <!-- filter-group .// -->
              {{-- Brand  --}}
      <article class="filter-group col-12 d-md-none">
       <h6 class="title">
           <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="collapse" data-bs-target="#brand"> Brand </a>
       </h6>
       <div class="filter-content collapse " id="brand">
           <div class="inner">
               @foreach ($brand as $item)

               <label class="custom-control custom-checkbox d-flex align-items-center my-1">
                 <input type="checkbox"  class="custom-control-input selector brand mr-1" value="{{ $item->brand }}">
                 <div class="custom-control-label custom-fs-15 ">&nbsp;&nbsp;{{ $item->brand }}&nbsp;&nbsp;
                 
                   </div>
               </label>
               @endforeach


           </div> <!-- inner.// -->
       </div>
   </article> <!-- filter-group .// -->
   <div class="col-md-4 offset-md-4 col-12">

    <select class="mr-2 form-control  " id="sort">
      <option value="1">sort by new first</option>
      <option value="2"> sort by old first</option>
      <option value="3">sort by A to Z</option>
      <option value="4">sort by Z to A</option>
    </select>
  </div>
  <hr class="mt-2 d-md-none">
		</div>
</header><!-- sect-heading -->
<div class="row row-sm product_grid ">
    @foreach ($product as $item)
    <div class="col-md-3 col-6">
      <a href="{{ route('product.detail',['id'=>$item->id,'slug'=>$item->slug]) }}" class="card product-card">
        <img src="{{ __getimagePath($item->image) }}"
            class="card-img-top" alt="{{ $item->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $item->name }}</h5>
            <div class="card-text text-dark d-flex justify-content-between">
                @if ($item->offer_price!=null)
                <span>
             {{ __getpriceUnit() . $item->offer_price }}
                </span>
              
                <span>
                    <s>
                        MRP {{ __getPriceUnit() }}{{ $item->price }}

                    </s>
                </span>
               
                @else    
                <span>
                    {{ __getpriceUnit() }} {{ $item->price }}
                       </span>

                @endif
                
            </div>
            <p class="card-text py-0 my-0">
               BV: {{ $item->bv }}
            </p>
         
        </div>
    </a>
  </div>
    @endforeach
 <div class="col-md-4 offset-md-4">
    <center>
        {{ $product->links()}}
    </center>
 </div>
</div> <!-- row.// -->



	</main> <!-- col.// -->

</div>
</div>
@endsection

@push('scripts')
<script>
	$(document).ready(function() {
	  $('#sort').on('change',function(){//onchange
	  var value=$(this).val();

  product_filter();
	});
	  $( "#mySlider" ).slider({//price range slider
	  range: true,
	  min: 0,
	  max: 25000,
	  values: [ 0, 25000 ],
	  step:50,
	  stop: function( event, ui ) {
  $( "#price" ).val( "Rs. " + ui.values[ 0 ] + " - Rs. " + ui.values[ 1 ] );
  $( "#hidden_max" ).val(ui.values[ 1 ]);
  $( "#hidden_min" ).val(ui.values[ 0 ]);


  }

  });
  $('#apply').click(function(){
    product_filter();
  })
  $( "#price" ).val( "Rs. " + $( "#mySlider" ).slider( "values", 0 ) +
		   " - Rs. " + $( "#mySlider" ).slider( "values", 1 ) );
	  //function filter data





  //function filter data
  function product_filter(){
  let order=$('#sort').val();
  let category=get_category('category');
  let subcategory=get_category('subcategory');
  let rating=get_category('rating');
  let brand=get_category('brand');


  let min=$( "#hidden_min" ).val();
  let max=$( "#hidden_max" ).val();
  let _token   = $('meta[name="csrf-token"]').attr('content');
  
		$.ajax({//aax call
		url:'{{ url('filterproduct/ajax/')}}',
		type:"GET",
     dataType:"html",
	  data:{min:min,max:max,category:category,subcatgeory:subcategory,brand:brand,rating:rating,order:order,_token:_token},
  beforeSend:function(){
  
    $(".product_grid").html("<div class='d-flex justify-content-center py-5'><div class='spinner-border custom-text-primary text-center ' role='status'></div></div>");

  
  },
  success:function(data){
    console.log(data);
	$('.product_grid').html(data);
  },
  
  })
	  }
  //getting category/brand
  function get_category(class_name){
	let product=[];
	$('.'+class_name+':checked').each(function(){
  product.push($(this).val());
	})
	return product;
  }

	$('.selector').on("click",function(){
	  product_filter();
	})
  })
  </script>

@endpush
