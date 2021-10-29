@php
    $img=DB::connection('mysql2')->table('websites')->first();
@endphp
@push('style')
<style>
    .hero-sm{ background: url(__getimagePath($img->newarival)) no-repeat;}
</style>
@endpush


<section class="my-2 custom-bs">
    @php
    $product=DB::connection('mysql2')->table('products')->where('status',1)->orderBy('id','desc')->limit(20)->get();
@endphp

        <div class="container">
            <div class="row bg-white">
                <div class="col-lg-2 ps-0">
                    <div class="hero-sm">
                        <div class="hero-body w-100 text-center">
                            <h3 class="hero-title custom-fs-30 custom-fw-400 ">
                                NEW ARRIVAL PRODUCT
                            </h3>
                            <a href="#" class="btn-style-1 mt-3 custom-fw-500 custom-bg-primary btn">
                                VIEW All
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 ">
                    <div class="owl-carousel product-carousel items-5">
                        @foreach ($product as $item)
                            
                        <a href="{{ route('product.detail',['id'=>$item->id,'slug'=>$item->slug]) }}" class="card product-card">
                            <img src="{{ __getimagePath($item->image) }}"
                                class="card-img-top" alt="{{ $item->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <div class="card-text text-dark d-flex justify-content-between">
                                    @if ($item->offer_price!=null)
                                    <span>
                                 {{ __getpriceUnit() . $item->offer_price }}
                                    </span>
                                  
                                    <span>
                                        <s>
                                            MRP {{ __getPriceUnit() }}{{ $item->price }}
        
                                        </s>
                                    </span>
                                   
                                    @else    
                                    <span>
                                        {{ __getpriceUnit() }} {{ $item->price }}
                                           </span>

                                    @endif
                                    
                                </div>
                                <p class="card-text py-0 my-0">
                                   BV:- {{ $item->bv }}
                                </p>
                             
                            </div>
                        </a>
                        @endforeach

                       
                    </div>
                </div>
            </div>
        </div>
    </section>