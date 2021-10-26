<div class="overlay" id="overlay" onclick="closeNav()">
</div>

<div id="mySidenav" class="sidenav">
    @php
       $category= DB::connection('mysql2')->table('categories')->where('status',1)->orderBy('id','desc')->get();
    @endphp
       <div class="row p-3 text-white custom-bg-primary">
        <div class="col-2">
            <i class="fas fa-user"></i>
        </div>
        <div class="col-8">
            <p class="mb-0 custom-cursor-pointer" onclick="closeNav()" data-bs-toggle="modal"
                data-bs-target="#exampleModal"> Login & Signup</p>
        </div>
    </div>
    @foreach ($category as $item)
    <div class="row px-3 py-1 custom-text-dark">
        {{-- <div class="col-2 py-2">
            <img src="{{ asset($item->image) }}" alt="{{ $item->category }}" class="img-fluid">
        </div> --}}
        <div class="col-10">
            <a href="#" class="mb-0 custom-fs-13"> {{ $item->category }}</a>
        </div>
    </div>
 

    @endforeach

  
</div>