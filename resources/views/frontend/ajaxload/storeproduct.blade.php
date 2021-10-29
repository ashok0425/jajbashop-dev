
@foreach ($product as $item)
<div class="col-md-3 col-6 mt-1">
    <div class="card">
       
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
                   BV: {{ $item->bv }}
                </p>
             
            </div>
        </a>
    </div>
</div>
@endforeach
