
        <div class="row">
         <div class="col-md-4 col-6 d-none d-md-inline d-sm-none">
             <div class="card">
                 <img src="{{ asset($product->image) }}" class="image img-fluid" alt="{{ $product->name }}">
                 <div class="card-body">


                 </div>

             </div>

         </div>


 <div class="col-md-4 col-6 d-none d-md-inline d-sm-none">
             <ul class="list-group">
   <li class="list-group-item">Name: <span class="name">{{ $product->name }}</span></li>
   <li class="list-group-item">Product ID: <span class="product_id">{{ $product->product_id }}</span></li>
   <li class="list-group-item">SKU: <span class="sku">{{ $product->sku }}</span></li>
   <li class="list-group-item">Brand:<span class="brand">{{ $product->brand }}</span> </li>
   <li class="list-group-item">Stock: <span class="stock">
       @if ($product->qty>0)
       <span class="badge bg-success">Available</span>
  @else    
  <span class="badge bg-danger">Out of stock</span>

   @endif</span> </li>
   <li class="list-group-item">Price: {{__getPriceunit()}}  <span class="price">   
    @if (isset($first))
    @if ($first->offer_price)
    {{ $first->offer_price }}
    @else 
    {{ $first->price }}
        
    @endif
        
    @else 
    @if($product->offer_price) 
    {{$product->offer_price  }}
    @else 
    {{ $product->price }}
@endif
    @endif
        
   
   </span> </li>

 </ul>

         </div>

         <div class="col-md-4 ">
            <li class=" d-block d-md-none d-sm-block">Stock: <span class="stock">   @if ($product->qty>0)
                <span class="badge bg-success">Available</span>
           @else    
           <span class="badge bg-danger">Out of stock</span>
         
            @endif</span> </li>
            <li class=" d-block d-md-none d-sm-block">Price: {{__getPriceunit()}}  <span class="price">
                @if (isset($first))
                @if ($first->offer_price)
               {{  $first->offer_price}}
                @else 
                {{ $first->price }}
                    
                @endif
                    
                @else 
                @if($product->offer_price) 
                {{$product->offer_price  }}
                @else 
                {{ $product->price }}
                @endif

                @endif
            </span> </li>
            <hr class="d-block d-md-none">
<form action="{{route('cart.store')}}" method="GET">
@csrf
     <input type="hidden" name="pid" class="pid" value="{{ $product->id }}">
     <input type="hidden" name="type" class="type" value="{{ $value }}">
     <div class="container-fluid">
     <div class="row">
         <div class="col-md-6 col-6">
            <div class="form-group">
                <div class="size">
                    @foreach ($size as $item)
                    <label class='d-flex py-0 my-2 align-items-center sizes'><input type='radio' value='{{ $item->id }}' name='size' required @if ($loop->first)
                        checked
                    @endif  >&nbsp;&nbsp; <div  class=' py-0 border-1 border px-2 '>{{ $item->size }}</div> </label>
                    @endforeach
                </div>
                 </div>
         </div>
         <div class="col-md-6 col-6">
            <div class="form-group ">
                <div class="color">

                    @foreach ($color as $item)
                    <label class='d-flex py-0 my-2 align-items-center'><input type='radio' value='{{ $item->id }}' name='color' required @if ($loop->first)
                        checked
                    @endif >&nbsp;&nbsp; <div style='background:{{ $item->color }};height:30px;width:50px;' class=' py-0'></div> </label>
                    @endforeach
                </div>


                    </div>
         </div>
     </div>
    </div>

     <div class="form-group mb-2">
      <label for="exampleInputcolor">Quantity</label>
     <div class="qty mt-1 mb-2 d-flex ">
        <button  class="incrementbtn px-4  text-white custom-bg-primary outline-none border-0"  type="button" data-input="demoInput"  @if ($product->qty<=0)
            disabled
        @endif>+</button>
        <input id="demoInput" type="number" readonly value="1" class="value text-center  py-1 w-25 " name="qty"  min="1" max='{{ $product->qty }}'>

        <button  class="decrementbtn px-4  text-white custom-bg-primary outline-none border-0" type="button" data-input="demoInput" @if ($product->qty<=0)
            disabled
        @endif>-</button>

                        </div>
 <button  class="btn custom-bg-primary border-0 outline-none btn-sm text-white submit add_to_cart "   @if ($product->qty<=0)
    disabled
@endif >Submit</button>

</form>
         </div>



        </div>
<script>
// {{-- price increment and decrement  --}}
		$('.incrementbtn').click(function(){
			let  qty= $(this).data('input');
			let   preval=parseInt($(document).find('#'+qty).val());
			let  id= $(this).data('id');
			let  price= $(this).data('price');
			let  charge= $(this).data('charge');

		   let element =$(this)
val=preval+1
		   $(document).find('#'+qty)[0].stepUp()
		   $.ajax({
			   url:'{{ url('cartqty') }}/'+val+'/'+id+'/'+price+'/'+charge,
			   type:"GET",
			   dataType:'json',
			   success:function(data){
           console.log(data);
				$(document).find('#priced'+id).html(data['total']);
      $('#carttotal').html(data['carttotal'])
      $('#subtotal').html(data['carttotal'])
      $('#grandtotal').html(data['grandtotal'])
      $('.delivery_charge').html(data['charge'])


			   }
		   })
		})

		$('.decrementbtn').click(function(){
			let  qty= $(this).data('input');
			let   preval=parseInt($(document).find('#'+qty).val());
			let  id= $(this).data('id');
			let  price= $(this).data('price');
			let  charge= $(this).data('charge');

                if(preval!==1){
                val=preval-1

                }
		   $(document).find('#'+qty)[0].stepDown()
		   $.ajax({
               url:'{{ url('cartqty') }}/'+val+'/'+id+'/'+price+'/'+charge,
			   type:"GET",
			   dataType:'json',
			   success:function(data){
				$(document).find('#priced'+id).html(data['total']);
                $('#carttotal').html(data['carttotal'])
                $('#subtotal').html(data['carttotal'])
                $('#grandtotal').html(data['grandtotal'])
                $('.delivery_charge').html(data['charge'])

			   }
		   })
      })


</script>



{{-- changing price on the basis of size  --}}
<script>
    $(document).on('click','.sizes',function(){
        $('.value').val(1);
      let input=$(this).children('input');
     let id=input.val();
      $.ajax({
        url:'{{ url('loadprice') }}/'+id,
        type:'GET',
        DataType:'Json',

        success:function(data){

          $('.price').html(data.price);
          $('.value').attr('max',data.qty);
          if(data.qty>=1){
            $('.add_to_cart').removeClass('d-none');
            $('.add_to_cart').addClass('d-inline-block');

          }else{
            $('.add_to_cart').addClass('d-none');
            $('.add_to_cart').removerClass('d-inline-block');
          }


        },

      })
    })
    </script>