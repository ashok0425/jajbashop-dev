<nav class="navbar sticky-top navbar-expand-lg navbar-light custom-bg-primary text-white custom-bs ">
    <div class="container-sm">
        <div class="row w-100">
            <!-- Modal -->
            <div class="nav-login modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 row">
                            <div class="col-sm-4 bg-transparent ">
                                <div class="custom-bg-primary px-4 py-5 h-100 rounded">
                                    <h2
                                        class="text-white custom-fs-28 custom-fw-700 mb-sm-3 mb-0 text-center text-sm-start">
                                        Login
                                    </h2>
                                
                                </div>
                            </div>
                            <div class="col-sm-8 px-4 py-5">
                                <form action="{{ route('login') }}" class="modal-login-form" method="POST">
                                    <div class="input-wrap mb-5 custom-b-bot">
                                        <input type="email" name="email" class="w-100 pe-1 py-2 border-0"
                                            placeholder="Enter Email" id="email" required>
                                    </div>
                                    <div
                                        class="d-flex mb-5 justify-content-between align-items-center input-wrap custom-b-bot mb-3">
                                        <input type="password" name="password" class="w-100 pe-1 py-2 border-0"
                                            placeholder="Enter Password" id="password" required>
                                        <a href="#"
                                            class="custom-text-primary custom-fs-15 custom-fw-500">Forgot?</a>
                                    </div>
                                    <p class="custom-text-dark custom-fs-12 custom-fw-400">
                                        By continuing, you agree to Jajbashop's <a href="#"
                                            class="custom-text-primary">Terms of Use and Privacy Policy.</a>
                                    </p>
                                    <div class="btn-wrap mb-3">
                                        <button class="btn custom-fw-700 btn-style-1 custom-bg-orange w-100">
                                            Login
                                        </button>
                                    </div>
                                    {{-- <div class="text-center custom-text-dark mb-3 custom-fs-14 w-100">
                                        OR
                                    </div>
                                    <div class="btn-wrap mb-5">
                                        <button class="btn custom-fw-700 btn-style-1 otp-btn bg-white w-100">
                                            Request OTP
                                        </button>
                                    </div> --}}
                                    <div class="text-center mt-5">
                                        <a href="{{ route('register') }}" class="custom-fs-14 custom-text-primary custom-fw-500">New to
                                            Jajbashop? Create an account</a>
                                    </div>
                                </form>
                            </div>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-6 px-0 d-flex">
                <div onclick="openNav()"
                    class="d-inline-block d-lg-none text-white py-1 pe-3 custom-cursor-pointer">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="d-flex flex-column">
                    <a class="navbar-brand" href="{{ route('/')}}">
                        {{-- <img src="assets/img/flipkart-plus_logo.png" alt="" class="img-fluid"> --}}
                        <strong class="text-white">JAJBASHOP</strong>
                    </a>
                    {{-- <div class="custom-fs-11">
                        <a href="#" class="custom-fs-11 text-white"><i>Explore <span
                                    class="custom-text-secondary">Plus</span></i>
                            <img src="assets/img/plus_aef861.png" style="max-width: 10px;" alt="" class="img-fluid">
                        </a>
                    </div> --}}
                </div>
            </div>

            <div class="col-lg-4 col-6 px-0 mb-2 mb-lg-0 d-flex d-lg-none align-items-center">
                <ul class="navbar-nav d-flex w-100 justify-content-end flex-row me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-shopping-cart me-1"></i></a>
                    </li>
                    <li class="nav-item d-flex  align-items-center">
                        <button type="button" class=" border-0 text-white custom-bg-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Login
                        </button>
                    </li>
                </ul>
            </div>

            <div class="col-lg-6 px-0 d-flex justify-content-center">
                <form class="d-flex justify-content-center justify-content-lg-start w-100 h-100 align-items-center">
                    <input class="form-control w-100 search" type="search"
                        placeholder="Search for products, brands and more" aria-label="Search">
                    <button class="btn search-btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="col-lg-4 d-none d-lg-flex justify-content-end align-items-center">
                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item d-flex align-items-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Login
                        </button>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-shopping-cart me-1"></i> Cart</a>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</nav>