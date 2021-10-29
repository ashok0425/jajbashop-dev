@php
    $banner=DB::connection('mysql2')->table('advertisments')->where('status',1)->where('place',1)->orderBy('id','desc')->limit(10)->get();
@endphp
<section class="my-2 ">
    <div class="container-fluid">
        <div class="owl-carousel product-carousel carousel-banner">
            @foreach ($banner as $item)
            <a href="{{ $item->title }}">
                <img src="{{ __getimagePath($item->image) }}" alt="banner image" class="img-fluid">
            </a>
            @endforeach
        
        </div>
    </div>
</section>