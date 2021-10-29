
@push('style')
<style>
  /* Style the tab */
.tab {
background-color: var(--custom-blue);
color:white;
/* height: 500px; */

}
.tab  .img{
 border-bottom: 1px solid var(--white);
 padding: 10px;
}
/* Style the buttons inside the tab */
.tab button {
display: block;
background-color: inherit;
padding: 22px 16px;
width: 100%;
border: none;
outline: none;
text-align: left;
cursor: pointer;
transition: 0.3s;
font-size: 17px;
border-bottom: 1px solid white;

}


/* Create an active/current "tab button" class */
.tab .tablinks.active {
background-color: white;
color: #(--custom-blue)!important;
}

.image-input label {
display: block;
color: rgb(106, 116, 117);
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


</style>
@endpush
@extends('frontend.master')
@section('content')
@section('header')
<section class="card ">
        <div class="card-body">
          <h2 class="title-page custom-text-secondary custom-fw-700">My Profile</h2>
    </div> <!-- container //  -->
    </section>
@endsection

<div class="container    my-5 ">

<div class="card shadow">
  <x-errormsg/>
  <div class="row card-body">
    <div class="col-6 d-block d-md-none">
      <div class="dropdown">
        <button class="btn custom-bg-secondary dropdown-toggle text-white" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Profile Menu
        </button>
        <div class="dropdown-menu px-2" aria-labelledby="dropdownMenu2">
          <a class="btn custom-bg-secondary text-white  tablinks my-2 d-block" data-id="1" >Profile</a>
          <a class="btn custom-bg-secondary text-white  tablinks my-2 d-block" data-id="7" >KYC</a>
          <a class="btn custom-bg-secondary text-white tablinks my-2 d-block"  data-id="3"> Wishlist</a>
      <a class="btn custom-bg-secondary text-white tablinks my-2 d-block" data-id="4">Order List</a>
      <a class="btn custom-bg-secondary text-white tablinks my-2 d-block" data-id="5">Refund Order </a>
      <a class="btn custom-bg-secondary text-white tablinks my-2 d-block" data-id="6">Cancel Order </a>

      <a class="btn custom-bg-secondary text-white tablinks my-2 d-block" data-id="2"> Password</a>
      <a class=" btn btn-danger my-2 d-block" href="{{ route('profile.logout') }}">Logout</a>

        </div>
      </div>
    </div>
<div class="col-3 offset-2 d-block d-md-none">
  <div class="img">
    <img src="@if(Auth::user()->profile_photo_path==null)  {{asset('frontend/user.png') }}    @else  {{asset(Auth::user()->profile_photo_path)}} @endif" alt="{{Auth::user()->profile_photo_path}}" width="60" height="60" class="rounded-circle">

</div>
</div>


    <div class="col-md-4 col-md-4 d-none d-md-block">
   
    <div class="tab ">
        <div class="img">
            <img src="@if(Auth::user()->profile_photo_path==null)  {{asset('frontend/user.png') }}    @else  {{asset(Auth::user()->profile_photo_path)}} @endif" alt="{{Auth::user()->profile_photo_path}}" width="100" height="100" class="rounded-circle">
            <div class="name">
                <p>{{Auth::user()->name}}</p>
            </div>
        </div>
     
         <button class="tablinks " data-id="1" >Profile</button>
         <button class="tablinks " data-id="7" >KYC</button>
        
        <button class="tablinks" data-id="2">Change Password</button>
        <button class="tablinks"  data-id="3">My Wishlist</button>
        <button class="tablinks" data-id="4">Order History</button>
        <button class="tablinks" data-id="6">Cancel Order</button>

        <button class="tablinks" data-id="5">Refund Order</button>
       
        <button class="tablinks" >   <a class="tablinks d-block" href="{{ route('profile.logout') }}">Logout</a></button>
     

      </div>
    </div>
    <div class="col-md-8 col-12 detail card-body">
  
    </div>
  </div>
</div>
</div>

    
@endsection

@push('scripts')
<script>
  function loadprofileData(load){
    $.ajax({
      url:'{{ url('load-profile-data') }}/'+load,
      type:'GET',
      dataType:'html',
      beforeSend:function(){
        $(".detail").html("<div class='d-flex justify-content-center py-5'><div class='spinner-border custom-text-primary text-center ' role='status'></div></div>");


	},
			 success:function(data){
		$(".detail").html(data);
         

  },

    })
  }
  $('.tablinks').click(function(){
    let id=$(this).data('id');
    loadprofileData(id)
  })

</script>

@endpush


