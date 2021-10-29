@extends('frontend.master')
<style>
 
.tab {
  overflow: hidden;  
  margin-top: 2rem;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;

}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #f70;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #60c3d3;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border-top: none;
}



.image{
position: relative;
max-height: 300px;


}


  .image img{
      max-height: 300px;
  }
  .logos{
     z-index: 99;
     position: absolute;
     top: 65%;
     left: 45%;
     transform: translateY(-50%,-50%)
  }
.logos img{
    width: 140px;
    height: 140px;
border: 2px solid gray;
}






 /* rating  */
 .rating {
	  float:left;
  }
  /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
	 follow these rules. Every browser that supports :checked also supports :not(), so
	 it doesn’t make the test unnecessarily selective */
  .rating:not(:checked) > input {
	  position:absolute;
	  top:-9999px;
	  clip:rect(0,0,0,0);
  }
.col{
	color:rgb(180, 179, 179)!important;

  }
  .rating:not(:checked) > label {
	  float:right;
	  width:1em;
	  padding:0 .1em;
	  overflow:hidden;
	  white-space:nowrap;
	  cursor:pointer;
	  font-size:200%;
	  line-height:1.2;
	  color:rgb(175, 175, 175);
	  text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
  }
  
  .rating:not(:checked) > label:before {
	  content: '★';
  }
  
  .rating > input:checked ~ label {
	  color: #f70;
	  text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
  }
  .rtn{
	float: left;
	width: 100%;
  }
  .rating:not(:checked) > label:hover,
  .rating:not(:checked) > label:hover ~ label {
	  color: gold;
	  text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
  }
  
  .rating > input:checked + label:hover,
  .rating > input:checked + label:hover ~ label,
  .rating > input:checked ~ label:hover,
  .rating > input:checked ~ label:hover ~ label,
  .rating > label:hover ~ input:checked ~ label {
	  color: #ea0;
	  text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
  }
  
  .rating > label:active {
	  position:relative;
	  top:2px;
	  left:2px;
  }
  
  .checked{
	color: orange;
  }
  .at-share-btn-elements{
	  margin-top:35px!important;
  }
  .promo{
    text-decoration: underline;
    color: #f70;
  }
  .badges{
width: 200px;
z-index: 99;
     position: absolute;
     top: 1%;
     left: 85%;
     transform: translateY(-50%,-50%)
  }
  .badge_wrapper{
  padding: 14px 16px;
    
  }
</style>
@section('content')

<div class="container-fluid ">
    <div class="row">
        {{-- <div class="col-md-12 "><div class="image"><img src="{{asset($detail->cover_image)}}" alt="{{$detail->name}}" class="img-fluid" width="100%" height="300">
        
<div class=" logos "><img src="{{asset($detail->image)}}" alt="{{asset($detail->image)}}"></div>         
        </div>
      
      </div> --}}
<div class="col-md-12 col-12 ">
  <div class="tab" id="tab">
    <button class="tablinks custom-bg-orange"  data-id="{{ $detail->vendor_id }}" data-load="1">About</button>
    <button class="tablinks" data-id="{{ $detail->vendor_id }}" data-load="2">Seller  Information</button>
    <button class="tablinks" data-id="{{ $detail->vendor_id }}" data-load="3">Reviews</button>
    <button class="tablinks" data-id="{{ $detail->vendor_id }}" data-load="4">All Product</button>

  
  
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


    </div>

@endsection

@push('scripts')
<script>


// tabs 

loadproductDetail(1,{{  $detail->vendor_id }})
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
    url:'{{ url('seller-detail')}}/'+load+'/'+id,
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
  loadproductDetail(3,{{ $detail->vendor_id }})

})


// {{-- changing price on the basis of size  --}}
    $(document).on('click','.size',function(){
      let id=$(this).data('id');
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


    // making border in selected color 
    $('.color_img').on('click',function(){
$(this).parent('.color-label').siblings().css('outline','0px solid transparent');
$(this).parent('.color-label').css('outline','3px solid rgb(114, 114, 114)');
$id=$(this).data('text');
$(".color").val($id);
    })
    </script>

@endpush