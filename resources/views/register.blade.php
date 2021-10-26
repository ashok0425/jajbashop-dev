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


	<title>JAJBASHOP</title>


{{-- fontawsome  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
{{-- custom css --}}
	<link href="{{asset('admin/css/app.css')}}" rel="stylesheet">
	{{-- datatables  --}}
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>
	<link href='//cdn.datatables.net/responsive/2.2.9/css/dataTables.responsive.css'  rel="stylesheet" />
{{-- google font  --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;500;600;700;800&display=swap" rel="stylesheet">
    {{-- toastr  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<style>
*{
    font-family: 'Montserrat', sans-serif;
}
.card{
	border-top: 5px solid #01b4fa;
}


#myTable_filter{
	margin-bottom: 2rem!important;
}

h3{
	background:#01566b;
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
<body>
<div class="container-fluid mt-4">

    <div class="row">

        <div class="col-sm-12">
            <div class="card">

                <h3>Register</h3>
                <div class="card-body py-5 px-5" >

           <x-errormsg/>
@if (session()->has('register'))
    <div class="alert alert-success" role="alert">
        <p class="py-3 px-5">{{session()->get('register')}}</p>
    </div>
@endif


          <form action="{{route('member.register.refer')}}" method="POST">
                    @csrf
                    <input type="hidden" name="sponsor" class="form-control" required value="{{$userid}}">
                <div class="row">

               

                    <div class="col-md-6 my-2">
                        <label >Full Name<span class="text-danger">*</span>
</label>
                        <input type="text" name="name" class="form-control" required value="{{old('name')}}">
                    </div>
                    <div class="col-md-6 my-2">
                        <label >Email<span class="text-danger">*</span>
</label>

                        <input type="email" name="email" class="form-control" required value="{{old('email')}}">
                    </div>
                    <div class="col-md-6 my-2">
                        <label >Phone Number<span class="text-danger">*</span>
</label>
<div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">+91</span>
    </div>
    <input type="tel" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="phone" value="{{old('phone')}}" maxlength='10'>
  </div>
                    </div>






                    <div class="col-md-6 my-2">
                        <label >Adhar No
</label>

                        <input type="tel" name="adhar" class="form-control" value="{{old('adhar')}}" maxlength='12'>
                    </div>
                    <div class="col-md-6 my-2">
                        <label >Address<span class="text-danger">*</span>
</label>

                        <input type="text" name="address" class="form-control" required value="{{old('address')}}">
                    </div>
                    <div class="col-md-12">
<input type="submit" class="form-control" value="Register">
                    </div>
                </div>

                </form>
                <a href="{{route('login')}}" class='btn btn-info btn-block mt-3'>Login</a>
                </div>
                
            </div>
        </div>




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
</body>
</html>








