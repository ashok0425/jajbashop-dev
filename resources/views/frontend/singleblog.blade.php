@extends('frontend.master')

@section('content')


<div class="container">

<div class="row  my-5 mx-md-5">
    <div class="col-md-7">
        <header class="section-heading">
            <h2 class="section-title">{{ $blog->title }}</h2>
        </header><!-- sect-heading -->

        <article>
        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid mt-1 mb-3">

        <h6 class="date text-warning">{{ carbon\carbon::parse($blog->created_at)->format('d M F') }}</h6>

        <h6 class="text-warning">{{$blog->author}}</h6>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="addthis_inline_share_toolbox"></div>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60c809a3e6cdb001"></script>

        {!!$blog->detail!!}

    </div>
    <div class="col-md-5">
        @php
            $related=DB::table('blogs')->where('category_id',$blog->category_id)->orderBy('id','desc')->limit(6)->get();
        @endphp
      <h2>  Related Blogs</h2>
      @foreach ($related as $item)

        <div class="row my-3">
            <div class="col-md-4 offset-md-1">
<img src="{{ asset($item->image) }}" alt="" class="img-fluid">
            </div>
            <div class="col-md-7">
<p><a href="{{ route('blog.single',['id'=>$item->id,'title'=>$item->title]) }}">{{ $item->title }}</a></p>
            </div>
        </div>
      @endforeach

    </div>
</div>
</div>

@endsection
