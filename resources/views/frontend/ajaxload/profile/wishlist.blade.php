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
    img{
    width: 35%;
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
  </style>

@if (count($wish)>0)
<h5 class="custom-fw-700 border-bottom  custom-bg-secondary text-white py-1 py-md-3 px-md-4 px-1">Your wishlist item</h5>

<div class="container text-dark bg-white">
  
    @foreach ($wish as $item)
    <div class="row p-3 effects ">
        <div class="col-md-3 offset-md-1">
          <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->name }}">
        </div>
        <div class="col-md-3">
          <h5>{{ $item->name }}</h5>
          <small>{{ $item->short_desc }}</small>
         
        </div>
        <div class="col-md-2">
            <h5>Price</h5>

            <h6>{{ __getPriceunit() }} {{ $item->price }}</h6>
       
          </div>
        <div class="col-md-2">

          <a href="{{ route('wishlist.remove',['id'=>$item->id]) }}"><i class="fa fa-trash text-danger fa-2x mx-2"></i></a>
        </div>
      </div> 
    @endforeach
    
    <center><a href="{{ route('wishlist') }}" >Load All</a></center>
  </div>
  @else      
  <div class="my-5 py-md-5 py-0"></div>
  <div class="container">
   <div class="text-white custom-bg-secondary py-4 px-4">Your wishlist is empty</div>
  </div>
  <div class="py-5 my-5"></div>
    @endif
   