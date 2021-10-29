
    @push('style')
    <style>
      
       
        
        ul li a:nth-child(3){
        background: green;
        }
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
      .dlist-align{
          display: flex;
          justify-content: space-between;
      }
     





    
    </style>



    @endpush

@extends('frontend.master')
@section('content')


@if (count($cart)>0)

{{-- finding total delivery charge and total cart amont --}}
@php
    $carttotal=0;
    $shipping_charge=0;

    foreach($cart as $value){
        $carttotal+=$value->qty*$value->price;
        $shipping_charge+=$value->qty*$value->delivery_charge;

    }
@endphp

<section class="section-content ">
    <div class="container-fluid mb-5  ">
    <div class="row">
        <main class="col-md-8 mt-5 pb-2 mb-3 card shadow-sm px-0 mx-0 order-2 order-md-1">          
          <h3 class="custom-text-secondary custom-fw-700 border-bottom card-header bg-gray">Your Cart Item</h3>
            <div class="container text-dark  ">
                
                {{-- Running foreach loop for each cart item  --}}
                @foreach ($cart as $item)
                <div class="row pt-3 pb-2 px-2 border-bottom">
                    <div class="col-md-3">
                      <img src="{{ asset($item->image) }}" class="img-fluid w-25" alt="{{ $item->name }}">
                      <h5>{{ $item->name }}</h5>
                      @if ($item->color)
                   <span class="d-flex align-items-center justify-content-md-start justify-content-center">Color: &nbsp; <p style='background:{{ $item->color }};height:30px;width:50px;' class="py-0 my-0"></p></span>
                      @endif
                      @if ($item->size)
                      <span class="py-0 my-0">   Size: {{ $item->size }}</span>
                      @endif
                    </div>
                    <div class="col-md-3">
{{-- button to  increase and decrese item qty using ajax  --}}

                      <div class="qty  d-flex  slign-items-center">
                        <button  class="incrementbtn px-3    qtys"  type="button" data-input="demoInput{{ $item->id }}" data-id="{{ $item->id }}"  @if (Session::has('coupon')) disabled title="You can't increase item quantity once coupon is applied"
              
                        @endif  data-price="{{ $item->price }}" data-charge="{{ $item->delivery_charge }}">+</button>
                        <input id="demoInput{{ $item->id }}" type="number" readonly  class="value text-center   qtys" name="qty"  min="1" value="{{ $item->qty }}">
              
                        <button  class="decrementbtn   px-3 qtys"  type="button" data-input="demoInput{{ $item->id }}" data-id="{{ $item->id }}"  @if (Session::has('coupon'))disabled
                            title="You can't descrease item quantity once coupon is applied"
                        @endif data-price="{{ $item->price }}" data-charge="{{ $item->delivery_charge }}">-</button>
{{-- XX button to  increase and decrese item qty using ajax  XX--}}

                      </div>
                    </div>

                    <div class="col-md-3 text-center">
                      {{ __getPriceunit() }} <span id="subtotal">{{ $item->price*$item->qty }}</span>
                        <p>
                            {{ __getPriceunit() }}  {{ $item->price }}/Each

                        </p>
                    </div>

                    <div class="col-md-2 offset-md-1 ">
                      <a href="{{ route('wishlist.store',['id'=>$item->pid]) }}" ><i class="fa fa-heart custom-text-secondary fa-2x "></i></a>
                      &nbsp;&nbsp;  <a href="{{ route('cart.remove',['id'=>$item->id]) }}" ><i class="fa fa-trash text-danger fa-2x "></i></a>


                    </div>
                  </div> 
                @endforeach
                {{-- XX foreach loop end XX --}}
                <div class="row mt-1">
                  <div class="col-md-6 text-md-left text-center my-1">
                    <a href="{{ route('/') }}" class="btn custom-bg-primary text-white"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
                  </div>
                  <div class="col-md-6 text-md-right text-center my-1">
                    <a href="{{ route('checkout',['value'=>'checkout-now','id'=>0]) }}" class="btn custom-bg-secondary text-white">Checkout <i class="fas fa-arrow-right"></i> </a>
                  </div>

                </div>
              </div>
        </main> <!-- col.// -->


        {{-- Total cart amount section  --}}
        <aside class="col-md-3 offset-md-1 order-1 order-md-2">
            <div class="card shadow-sm  mt-5">
              <div class="card-header">
                Cart Total
              </div>
                <div class="card-body">
                    @if(Session::has('coupon'))
                    <div class="text-success ">Coupon  ({{ Session::get('coupon')['name'] }} ) hasbeen Applied</div>
                             @else
                             <form action="{{route('coupon')}}" method="POST" class="">
                                 @csrf
                                 <div class="form-group">
                                     <label class="custom-fw-500 custom-fs-20">Have coupon?</label>
                                     <div class="input-group">
                                         <input type="text" class="form-control" name="coupon" placeholder="Coupon code">
                                         <input type="hidden" class="form-control" name="buynow" value="0">
                                         <span class="input-group-append">
                                             <button class="btn custom-bg-secondary text-white">Apply</button>
                                         </span>
                                     </div>
                                 </div>
                             </form>
                                  @endif

                                  <hr>
                        @if(Session::has('coupon'))

                        <dl class="dlist-align">
                            <dt>Sub-Total :</dt>
                            <dd class="text-right">{{ __getPriceunit() }} {{ number_format((float)Session::get('coupon')['balance'],2)}}</dd>
                          </dl>
                          <dl class="dlist-align">
                              <dt>Coupon <a href="{{route('coupon.remove')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash text-light"></i></a>:</dt>
                              <dd class="text-right">{{Session::get('coupon')['discount']}}%</dd>
                            </dl>

                            <dl class="dlist-align">
                                <dt>Shipping :</dt>
                                <dd class="text-right ">{{ __getPriceunit() }} <span class="delivery_charge"> {{ $shipping_charge }}</span> </dd>
                              </dl>
                              <dl class="dlist-align">
                                <dt>Total:</dt>
                                <dd class="text-right ">{{ __getPriceunit()}}  {{ number_format((float) ___getPriceafterVat(Session::get('coupon')['balance'], 0,$shipping_charge),2) }}</dd>
                              </dl>
                            @else


                        <dl class="dlist-align">
                            <dt>Sub-Total :</dt>
                            <dd class="text-right">{{ __getPriceunit() }} <span id="subtotal">{{ number_format((float)$carttotal,2)}}</span></dd>
                          </dl>


                            <dl class="dlist-align">
                                <dt>Shipping :</dt>
                                <dd class="text-right ">{{ __getPriceunit() }} <span class="delivery_charge"> {{ $shipping_charge }}</span> </dd>
                              </dl>
                              <dl class="dlist-align">
                                <dt>Total:</dt>
                                <dd class="text-right ">{{ __getPriceunit()}}  <span id="grandtotal">{{ number_format((float) ___getPriceafterVat($carttotal, 0,$shipping_charge),2) }}</span></dd>
                              </dl>
                                @endif


                        <hr>
                          
                </div> <!-- card-body.// -->
            </div>  <!-- card .// -->
        </aside> <!-- col.// -->
        {{-- XXTotal cart amount section End XX --}}

    </div>

    </div> <!-- container .//  -->
    </section>


    
    {{-- If cart is empty run this section  --}}
    @else
    <div class="my-5"></div>
   <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h5>Cart</h5>
              </div>
              <div class="card-body cart">
                  <div class="col-sm-12 empty-cart-cls text-center"> <i class="fas fa-shopping-cart fa-3x custom-text-secondary">

                  </i>
                      <h3><strong>Your Cart is Empty</strong></h3>
                      <h4>Add something to your cart :)</h4> <a href="{{ route('/') }}" class="btn custom-bg-secondary text-white cart-btn-transform m-3" data-abc="true"><i class="fas fa-arrow-left"></i> continue shopping</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
   </div>
   <div class="py-5 my-5"></div>

    @endif
    @endsection
    @push('scripts')

    


    	{{-- price increment and decrement  --}}
	<script>
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

        @endpush
