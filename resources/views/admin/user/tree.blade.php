@extends('admin.master')

@php
       define('PAGE','member')
@endphp
<style>
    .me{
        width: 80px;
        margin: auto;
    }
.box{
    width: 60px;
    display: inline-block;
    margin: 0 .5rem;

}
img{
    border-radius: 50%;

}
.img{
    border: 5px solid rgb(87, 202, 196);
    border-radius: 50%;
}
.box img{
    position: relative;
}
.detail{
    position: fixed;
    top: 0%;
    left: 50%;
    display: none;
    width: 400px;
text-align: center;
}
.detail-inner{
    margin: auto;
}
</style>
@section('main-content')
<div class="container-fluid">




   <div class="card  pb-3">
    <h3 class=" mb-3">Tree View of Memeber at different level</h3>
<div class="card-body">

         <div class="me">
             <img  src="{{asset('download.jpg')}}" alt="" class="img-fluid">
         </div>


         <div class="text-center mt-4 mb-0 pb-0">
            Level 1
<div class="mainbox mt-0 pt-0">

         @php
    $member=DB::table('levels')->where('l1',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
    <img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>

<div class="text-center mt-4 mb-0 pb-0">
    Level 2
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l2',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>



<div class="text-center mt-4 mb-0 pb-0">
    Level 3
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l3',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>



<div class="text-center mt-4 mb-0 pb-0">
    Level 4
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l4',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>




<div class="text-center mt-4 mb-0 pb-0">
    Level 5
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l5',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>



<div class="text-center mt-4 mb-0 pb-0">
    Level 6
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l6',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>



<div class="text-center mt-4 mb-0 pb-0">
    Level 7
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l7',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>

<div class="text-center mt-4 mb-0 pb-0">
    Level 8
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l8',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>


<div class="text-center mt-4 mb-0 pb-0">
    Level 9
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l9',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>



<div class="text-center mt-4 mb-0 pb-0">
    Level 10
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l10',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>


<div class="text-center mt-4 mb-0 pb-0">
    Level 11
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l11',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>


<div class="text-center mt-4 mb-0 pb-0">
    Level 12
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l12',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>


<div class="text-center mt-4 mb-0 pb-0">
    Level 13
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l13',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>


<div class="text-center mt-4 mb-0 pb-0">
    Level 14
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l14',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>

<div class="text-center mt-4 mb-0 pb-0">
    Level 15
<div class="mainbox mt-0 pt-0">

 @php
$member=DB::table('levels')->where('l15',$id)->get();
@endphp

@foreach ($member as $item)
<div class="box">
<img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">

</div>
@endforeach
</div>
</div>
    </div>
</div>
<a href="{{route('admin.user.all')}}" class="btn btn-info">Back</a>

</div>

<div class="detail">

    <div class="detail-inner">
        <div class="card">
            <div class="card-body">
        <h4>User Detail</h4>

        <p>
            Name: <span id="name"></span>
        </p>
        <p>
            User ID: <span id="userid"></span>
        </p>
        <p>
            Phone: <span id="phone"></span>
        </p>
        <p>
            Email: <span id="email"></span>
        </p>
        <p>
            Adhar Card No: <span id="adhar"></span>
        </p>
        <p>
           Sponsored By: <span id="sponsor"></span>
        </p>

            </div>
        </div>
                </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('.box img').mouseover(function(){
            $(this).addClass('img');
          $id= $(this).data('id');
          $.ajax({
              url:'{{url('admin/loadmemberdetail')}}/'+$id,
              type:'GET',
              dataType:'json',
              success:function(data){
                $('#name').html(data['name'])
                $('#userid').html(data['userid'])
                $('#email').html(data['email'])
                $('#phone').html(data['phone'])
                $('#adhar').html(data['adhar'])
                $('#sponsor').html(data['sponsor_id'])
                $('.detail').addClass('d-block')
              }
          })
        })


        $('.box img').mouseout(function(){
            $(this).removeClass('img');
            $('.detail').removeClass('d-block')
            $('.detail').addClass('d-none')


        })
    })
</script>

@endpush
