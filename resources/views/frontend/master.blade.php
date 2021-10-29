@php
	$setting=DB::connection('mysql2')->table('websites')->first();

@endphp

@section('title')
{{ $setting->title }}
@endsection
@section('descr')
{{ $setting->descr }}
@endsection
@section('keyword')
{{ $setting->title }}
@endsection
@section('title')
{{ $setting->title }}
@endsection
@section('img')
{{ asset($setting->image) }}
@endsection
@section('url')
{{Request::url()}}
@endsection
@section('fev')
{{ asset($setting->fev) }}

@endsection
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta property="fb:app_id" content="457897745217012" />
<meta property="og:url"                content="@yield('url')" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="@yield('title')" />
<meta property="og:description"        content="@yield('descr')" />
<meta property="og:image"              content="@yield('img')" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="author" content="{{$seo->meta_author}}"> --}}
    <meta name="keyword" content="@yield('keyword')">
    <meta name="description" content="@yield('descr')">

    <link rel="icon" href="@yield('fev')" type="image/icon type">

        <title>@yield('title')</title>

    {{-- datatables  --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>
    <link href='https://cdn.datatables.net/responsive/2.2.9/css/dataTables.responsive.css'  rel="stylesheet" />
    <!-- Font awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

    {{-- jquery ui  --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- custom style -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/owl.carousel.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/main.css')}}" />
    {{-- toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
    type="text/css" />
<style>
.fa-cart-plus {
    font-size: 1.5rem!important;
}
.modal-content{
    border-radius: 0!important;
}
.bg_gray{
    background: var(--color-light);
    padding: 2.4rem 2rem;
    color: #000;
}


.qtys{
  border: 0;
  outline: 0;
background: var(--custom-blue);
color:#fff;
font-weight: bold;
padding-top:.4rem!important; 
padding-bottom:.4rem!important; 


}
a{
  text-decoration: none!important
}
.value{
  width:100px!important;
  background: transparent;
  border: 1px solid gray;
color:#000;
  
}



.tab {
  overflow: hidden;
  border: 1px solid var( --custom-blue);
  background-color: var( --custom-blue);
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
  color: #fff;

}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: var(--color-orange);
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: var(--color-orange);
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
.border_right{
  border-right: 1px solid gray;
}
.voiceon{
	color: red;
	padding: 3px 7px;
	border-radius: 50%;
	animation: myborder .7s infinite ease-in-out;

}
a{
	text-decoration: none!important;
}
a:hover{
	text-decoration: none!important;
}
@keyframes myborder {
  from {
	  border: 1px solid transparent;
}
  to {border: 1px solid red;
}
}

img{
	max-width: 100%!important;
}


/* ? FOR STAR RATING */
.star-container {
  display: flex;
  align-items: start;
  justify-content: center;
  flex-direction: row-reverse;
}

.radio {
  display: none;
}

.label {
  width: 50px;
  height: 50px;
  display: block;
  text-align: center;
  transition: 0.3s;
  cursor: pointer;
  color: #ddd;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 1px;
}

.star {
  transition: 0.3s;
  font-size: 3rem;
}

.star:hover {
  color: var(--custom-orange)!important;
  transform: scale(1.3, 1.3);
}

.radio:checked ~ label .star {
  color: var(--custom-orange)!important;
  transform: scale(1.3, 1.3);
}
.radio:checked ~ label:hover .star {
  transform: scale(1, 1)!important;
}

.radio:checked ~ label:hover .star {
  color: var(--custom-orange)!important;

}
   </style>
@stack('style')

</head>

	<body class="custom-bg-gray">

		@include('frontend.includes.sidenav')
	  
		  <!-- Header Section  -->
		@include('frontend.includes.header')
		 
		  <!-- Carousel SM  -->
		  @include('frontend.includes.category')
		{{-- main content  --}}
	  
		@yield('content')
		  <!-- Footer Section  -->
		@include('frontend.includes.footer')
		 
		


<!--Order Traking Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Track Your Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

		</div>
		<div class="modal-body">
	 <form method="post" action="{{route('track.my.order')}}">
	  @csrf
	  <div class="modal-body">
		<label> Email Address</label>
		<input type="text" name="email" required class="form-control" >
		  <label> Order ID</label>
		  <input type="text" name="code" required class="form-control" >
	  </div>

	   <button class="btn btn-warning" type="submit">Track Now </button>

	 </form>


		</div>

	  </div>
	</div>
  </div>

{{-- view product model  --}}
<!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade " id="viewmodal" tabindex="-1" aria-labelledby="viewmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-scrollable ">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="viewmodalLabel">Quick View</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body viewmodal">
          </div>
        </div>
      </div>

  </div>




  <!-- JS  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('frontend/assets/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('frontend/js/main.js')}}"></script>


{{-- toastr  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  {{-- elvator zoom jquery --}}
  <script src='{{ asset('frontend/jquery.elevatezoom.js')}}'></script>

  {{-- jquery ui --}}
<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js "></script>
{{-- datatables  --}}
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
@stack('scripts')

{{-- quickview  --}}

<script>
	   $('.quickview').click(function(){

      let id=$(this).data('id');
      let value=$(this).data('text');
			$.ajax({
			 url: "{{ url('/product/quickview') }}/"+id+'/'+value,
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









{{-- datatables iniziing --}}
<script>
    if(window.innerWidth<=700){
        var table = $('#myTable').DataTable({
                "scrollX": true,

			
			});
     
    }else{

			var table = $('#myTable').DataTable({
              
			});
      
    }
	</script>



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


  {{-- toastr  --}}
  <script>
	@if(Session::has('messege'))//toatser
	  var type="{{Session::get('alert-type','info')}}"
	  switch(type){
		  case 'info':
			   toastr.info("{{ Session::get('messege') }}");
			   break;
		  case 'success':
			  toastr.success("{{ Session::get('messege') }}");
			  break;
		  case 'warning':
			 toastr.warning("{{ Session::get('messege') }}");
			  break;
		  case 'error':
			  toastr.error("{{ Session::get('messege') }}");
			  break;
	  }
	@endif
	</script>


{{-- search product  --}}
<script>
	$('#search').keyup(function(){
		$('.search_result').html('')

		let name=$(this).val();
		let category=$('#category').val();
		if(name!=''){

$.ajax({
	url:'{{ url('loadproduct') }}/'+name+'/'+category,
	type:'GET',
	dataType:'json',
	success:function(data){
		console.log(data);
		$('.search_result').html(data)
	}
})
}

	})
	$(document).on('click','.filters',function(e){
		e.preventDefault();
		let val=$(this).html();
		$('.main_search').val(val)
		$('.search_result').html('')

	})
</script>






<script>
	var message = $('.main_search');

	var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
	var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

	var grammar = '#JSGF V1.0;'

	var recognition = new SpeechRecognition();
	var speechRecognitionList = new SpeechGrammarList();
	speechRecognitionList.addFromString(grammar, 1);
	recognition.grammars = speechRecognitionList;
	recognition.lang = 'en-US';
	recognition.interimResults = false;

	recognition.onresult = function(event) {
		var last = event.results.length - 1;
		var command = event.results[last][0].transcript;
		message.val(command) ;
		$('.voice-icon').removeClass('voiceon');
		$('.voice-icon').addClass('text-dark');

		  
	};

	recognition.onspeechend = function() {
		recognition.stop();
		$('.voice-icon').removeClass('voiceon');
		$('.voice-icon').addClass('text-dark');
	};

	recognition.onerror = function(event) {
		message.value = '';
		$('.voice-icon').removeClass('voiceon');
		$('.voice-icon').addClass('text-dark');
	}        

	

$('.voice-icon').click(function(){
	$(this).toggleClass('voiceon');
	recognition.start();

	$(this).removeClass('text-dark');

})

</script>
</body>
</html>













