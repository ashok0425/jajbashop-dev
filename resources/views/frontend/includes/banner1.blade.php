@php
    $banner=DB::connection('mysql2')->table('banners')->where('status',1)->orderBy('id','desc')->first();
@endphp
<section class="d-lg-block my-2 ">
    <div class="container">
        <a href="#">
            <img src="{{ __getimagePath($banner->image) }}" alt="banner image" class="img-fluid">
        </a>
    </div>
</section>