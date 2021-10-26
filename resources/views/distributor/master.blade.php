<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Beliama Pvt ltd">
	<meta name="author" content="Beliama">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="keywords" content="Beliama Pvt ltd">

	<link rel="shortcut icon" href="{{asset('logo.png')}}" />


	<title>JaJbashop</title>


{{-- fontawsome  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
{{-- custom css --}}
	<link href="{{asset('admin/css/app.css')}}" rel="stylesheet">

	{{-- datatables  --}}
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;500;600;700;800&display=swap" rel="stylesheet">
    {{-- toastr  --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	{{-- summernote css  --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


<style>

*{
    font-family: 'Montserrat', sans-serif;
}
.content {
	background:#00a0e3!important;
}
th,tr{
	color: #000!important;
}
.card{
	border-top: 5px solid #ee1237;
}


#myTable_filter{
	margin-bottom: 2rem!important;
}

h3{
	background:#ff1414;
	color: #fff;
	font-weight: bold;
	font-size: 1.1rem;
	padding: .4rem 1rem;
}

.image-input {
	text-align: center;
}

.image-input input {
	display: none;
}

.image-input label {
	display: block;
	color: #FFF;
	background: #000;
	padding: .3rem .6rem;
	font-size: 115%;
	cursor: pointer;
  max-width: 300px;
}

.image-input label i {
	font-size: 125%;
	margin-right: .3rem;
}

.image-input label:hover i {
	animation: shake .35s;
}

.image-input img {
	max-width: 175px;
	display: none;
}

.image-input span {
	display: none;
	text-align: center;
	cursor: pointer;
}
.image-preview{
  display: none;
}

@keyframes shake {
	0% {
		transform: rotate(0deg);
	}

	25% {
		transform: rotate(10deg);
	}

	50% {
		transform: rotate(0deg);
	}

	75% {
		transform: rotate(-10deg);
	}

	100% {
		transform: rotate(0deg);
	}
}
input[type=submit]{
  background: #176183!important;
  color:#fff;
  border-color: #176183!important;
  outline: none;
}
input[type=submit]:hover{
  background: #176183!important;
  color:#fff;
  border-color: #176183!important;
  outline: none;
}
</style>

<style>

	.loading{
	  background: rgba(0,0,0,.4);
	  width: 100%;
	  height: 100vh;
	  position: fixed;
	  top: 0;
	  left: 0;
	  z-index: 999999;
	  display: none;
	}
.loader {
 border: 16px solid #f3f3f3; /* Light grey */
 border-top: 16px solid rgb(3, 252, 252); /* Blue */
 border-radius: 50%;
 width: 70px;
 height: 70px;
 animation: spin 2s linear infinite;
position: fixed;
top: 50%;
left: 50%;
transform: translate(-50%,-50%);

z-index: 9999;

}

@keyframes spin {
 0% { transform: rotate(0deg); }
 100% { transform: rotate(360deg); }
}

.items{
	position: relative;
    padding-bottom: 5px;
    padding-left: 14px;
    border-left: 2px solid #e4e8eb;
}
.items::after{
	content: "";
    display: block;
    position: absolute;
    top: 0;
    left: -6px;
    width: 10px;
    height: 10px;
    border-radius: 6px;
    background: #ffffff;
    border: 1px solid #f00c0c;
}
   </style>
   @stack('style')
</head>

<body>
	<div class="loading">

		<div class="loader"></div>
	  </div>
	<div class="wrapper">
        {{-- include sidebar --}}
@include('distributor.layout.sidebar')

		<div class="main">
        {{-- include header --}}

@include('distributor.layout.header')

			<main class="content px-3">
       {{--Dyanmic content --}}
    @yield('main-content')

			</main>


		</div>
	</div>

{{-- bootstrap  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

{{-- custom js --}}
<script src="{{asset('admin/js/app.js')}}"></script>

{{-- toastr  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- datatables  --}}
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
{{-- sweet alert  --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	{{-- fetching data category,subcategory --}}


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
{{-- !-- include summernote js --> --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

	@stack('scripts')

<script>
    // {{-- inializing summernote  --}}
$(document).ready(function() {
	$('#summernote').summernote();
	$('#summernote1').summernote();
	$('#summernote2').summernote();
	$('#summernote3').summernote();
	$('#summernote4').summernote();



  });
			// Add the following code if you want the name of the file appear on select
			$('#imageInput').on('change', function() {
$input = $(this);
if($input.val().length > 0) {
  fileReader = new FileReader();
  fileReader.onload = function (data) {
	   $('.image').css('display','none')
  $('.image-preview').attr('src', data.target.result);
  }
  fileReader.readAsDataURL($input.prop('files')[0]);
//   $('.image-button').css('display', 'none');
  $('.image-preview').css('display', 'block');
  $('.change-image').css('display', 'block');
}
});
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


    {{-- file upload  --}}
    <script>
        $("form").on("change", ".file-upload-field", function(){
    $(this).parent(".file-upload-wrapper").attr("data-text",         $(this).val().replace(/.*(\/|\\)/, '') );
});
    </script>
{{-- datatables iniziing --}}
<script>
    if(window.innerWidth<=700){
        var table = $('#myTable').DataTable({
                "scrollX": true,

				select: true,
				dom: 'Blfrtip',
				lengthMenu: [
					[10, 25, 50, -1],
					['10 row', '25 row', '50 row', 'All Rows']
				],
				dom: 'Bfrtip',
				buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5 ]
                }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'colvis',
                 
                    },
                    'pageLength',
                ]
			});
     
    }else{

			var table = $('#myTable').DataTable({
                // "scrollX": true,
				select: true,
				dom: 'Blfrtip',
				lengthMenu: [
					[10, 25, 50, -1],
					['10 row', '25 row', '50 row', 'All Rows']
				],
				dom: 'Bfrtip',
        buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5 ]
                }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'colvis',
                 
                    },
                    'pageLength',
                    
                ]
			});
      
    }
	</script>
<script>
 $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
           swal({
             title: "Are you Want to delete?",
             text: "Once Delete, This will be Permanently Delete!",
             icon: "warning",
             buttons: true,
             dangerMode: true,
           })
           .then((willDelete) => {
             if (willDelete) {
                  window.location.href = link;
             } else {
               swal("Safe Data!");
             }
           });
       });
</script>
</body>

</html>
