<style>
    .rounded_circle{
      width: 70px!important;
      height:70px!important;
       margin: auto!important;
    }
  </style>
<section class="custom-bs bg-white my-2 mt-lg-0 custom-b ">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-1 d-flex align-items-center">
            <div onclick="openNav()"
            class="d-none d-md-block text-primary py-1 pe-3 custom-cursor-pointer">
            <i class="fas fa-bars fa-2x"></i>
        </div>
        </div>
      <div class="col-md-11">

            <div class="owl-carousel product-carousel items-10">
                {{-- fetching category from database 2  --}}
                @php
                $category= DB::connection('mysql2')->table('categories')->where('status',1)->orderBy('id','desc')->get();
             @endphp
             @foreach ($category as $item)
                 
                <a href="{{ route('store.category',['id'=>$item->id,'name'=>$item->category]) }}" class="wrap text-center">
                    <div class="img-wrap mb-2 ">
                        <img src="{{ __getimagePath($item->image) }}" alt="category image" class="rounded_circle img-fluid" >
                    </div>
                    <h3 class="custom-text-black custom-fs-14 custom-fw-500 mb-1">{{ $item->category }}</h3>
                </a>
             @endforeach
               
            </div>
      </div>
    </div>

    </div>
</section>








       