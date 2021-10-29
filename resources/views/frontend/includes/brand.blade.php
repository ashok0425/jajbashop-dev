<section class="my-2 sponsored ">
    @php
        $brand=DB::connection('mysql2')->table('brands')->orderBy('id','desc')->get();
    @endphp
    <div class="container">
        <div class="custom-b bg-white px-3">
            <h2 class="custom-fs-20 custom-fw-500 my-4">Featured Brands</h2>
            <div class="owl-carousel items-6 product-carousel">
                @foreach ($brand as $item)
                    
                <a href="{{ route('store.brand',['id'=>$item->id,'name'=>$item->brand]) }}">
                    <img src="{{ __getimagePath($item->image) }}" alt="{{ asset($item->brand) }}" class="img-fluid p-3" width="200">
                </a>
                @endforeach
                
            
            </div>
        </div>

    </div>
</section>