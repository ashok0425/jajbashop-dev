@extends('member.master')

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
         {{-- looping through for loop to get level data up to 100 level  --}}
         @for ($i=1;$i<=100;$i++)
         @php
             $l='l'.$i;
         @endphp
       
                <div class="text-center mt-4 mb-0 pb-0">
                    Level {{ $i }}
        <div class="mainbox mt-0 pt-0">
        
                 @php
            $member=DB::table('levels')->where("$l",Auth::user()->userid)->get();
        @endphp
        
        @foreach ($member as $item)
        <div class="box">
            <img data-id='{{$item->user_id}}' src="{{asset('download.jpg')}}" alt="" class="img-fluid">
        
        </div>
        @endforeach
        </div>
        </div>
         @endfor



    </div>
</div>
<a href="{{route('member.all')}}" class="btn btn-info">Back</a>

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
              url:'{{url('member/loadmemberdetail')}}/'+$id,
              type:'GET',
              dataType:'json',
              success:function(data){
                $('#name').html(data['name'])
                $('#userid').html(data['userid'])
                $('#phone').html(data['phone'])
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
