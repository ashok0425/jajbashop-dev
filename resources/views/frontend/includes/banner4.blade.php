<section class="my-2 banners ">
    @php
    $banner=DB::connection('mysql2')->table('advertisments')->where('status',1)->where('place',4)->orderBy('id','desc')->limit(6)->get();

@endphp
    <div class="container">
        <div class="d-grid-3">
            @foreach ($banner as $banner2)
                
            <a href="{{ $banner2->title }}" class="custom-bs">
                <img src="{{ __getimagePath($banner2->image) }}" alt="{{ $banner2->image }}" class="img-fluid">
            </a>
            @endforeach
         
           
        </div>
    </div>
</section>