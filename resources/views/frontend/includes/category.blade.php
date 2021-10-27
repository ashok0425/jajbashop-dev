<style>
    .rounded_circle{
      width: 80px!important;
      height:80px!important;
      border-radius: 50%!important;

    }
  </style>
<section class="custom-bs bg-white my-2 mt-lg-0 custom-b py-1">
    <div class="container-sm">
            <div class="owl-carousel product-carousel items-10">
                {{-- fetching category from database 2  --}}
                @php
                $category= DB::connection('mysql2')->table('categories')->where('status',1)->orderBy('id','desc')->get();
             @endphp
             @foreach ($category as $item)
                 
                <a href="#" class="wrap text-center">
                    <div class="img-wrap mb-2 ">
                        <img src="{{ __getimagePath($item->image) }}" alt="category image" class="" >
                    </div>
                    <h3 class="custom-text-black custom-fs-14 custom-fw-500 mb-1">{{ $item->category }}</h3>
                </a>
             @endforeach
               
            </div>
    </div>
</section>








       