<div class="row py-5">

@foreach ($product as $item)
<div class="col-md-2 col-6">
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
</div>

<script>
    	   $('.quickview').click(function(){

let id=$(this).data('id');
let value=$(this).data('text');
      $.ajax({
       url: "{{ url('/product/quickview') }}/"+id,
       type: "GET",
       dataType:"html",
       beforeSend:function(){
  $(".viewmodal").html("<div class='d-flex justify-content-center py-5'><div class='spinner-border custom-text-primary text-center ' role='status'></div></div>");


},
       success:function(data){
  $(".viewmodal").html(data);
   
       },
       complete:function(){
  // $(".viewmodal").html("");

}
      })
  })
</script>


{{-- changing price on the basis of size  --}}
<script>
$(document).on('click','.sizes',function(){
  $('.qty').val(1);
let input=$(this).children('input');
let id=input.val();
$.ajax({
  url:'{{ url('loadprice') }}/'+id,
  type:'GET',
  DataType:'Json',

  success:function(data){
    $('.price').html(data.price);
    $('.qty').attr('max',data.qty);

  },

})
})
</script>

