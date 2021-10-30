<div class="d-md-block">
    <section class="custom-b-bot text-white custom-bg-blue">
        <div class="container">
            <div class="row">
                <div class="col-12 pt-5 pb-3">
                    <div class="row ">
                        
                        <div class="col-lg-2 col-6">
                            <h5 class="custom-text-dark mb-3 custom-fs-12 text-uppercase">Links</h5>
                            <ul class="custom-fs-12 footer-ul">
                                <li class="mb-2"><a href="#" class="text-white">About us</a></li>
                                <li class="mb-2"><a href="#" class="text-white">Term & Condition</a></li>
                                <li class="mb-2"><a href="#" class="text-white">Privacy Policy</a></li>
                                <li class="mb-2"><a href="#" class="text-white">Refund Policy</a></li>
                                <li class="mb-2"><a href="#" class="text-white">Price & Payment</a></li>
                                <li class="mb-2"><a href="#" class="text-white">Carrer</a></li>
                                <li class="mb-2"><a href="#" class="text-white">Download business plan</a></li>


                   
                            </ul>
                        </div>
                        <div class="col-lg-2 col-6">
                            <h5 class="custom-text-dark mb-3 custom-fs-12 text-uppercase">Acount</h5>
                            <ul class="custom-fs-12 footer-ul">
                                <li class="mb-2"><a href="#" class="text-white">
                                 Member Login
                                </a></li>

                                <li class="mb-2"><a href="#" class="text-white">Super Distributor Login</a></li>

                                <li class="mb-2"><a href="#" class="text-white"> Distributor Login</a></li>

                                <li class="mb-2"><a href="#" class="text-white">Seller Login</a></li>
                            
                            </ul>
                        </div>
                        @php
                            $social=DB::connection('mysql2')->table('websites')->first();
                        @endphp
                        <div class="col-lg-2 col-6">
                            <h5 class="custom-text-dark mb-3 custom-fs-14 text-uppercase">SOCIAL</h5>
                            <ul class="custom-fs-12 footer-ul">
                                @if ($social->facebook)                                    
                                <li class="mb-2"><a href="#" class="text-white"><i class="fab fa-facebook"></i> Facebook</a></li>
                                @endif

                                @if ($social->twitter)                                    
                                <li class="mb-2"><a href="#" class="text-white"><i class="fab fa-twitter"></i> Twitter</a></li>
                                @endif

                                @if ($social->instagram)                                    
                                <li class="mb-2"><a href="#" class="text-white"><i class="fab fa-instagram"></i>Instagram</a></li>
                                @endif

                                @if ($social->tiktok)                                    
                                <li class="mb-2"><a href="#" class="text-white"><i class="fab fa-telegram"></i> Telegram</a></li>
                                @endif

                             
                               
                            </ul>
                        </div>



                     

                    <div class="col-lg-2 col-6">
                        <h5 class="custom-text-dark mb-3 custom-fs-14 text-uppercase">Media</h5>
                        <ul class="custom-fs-12 footer-ul">
                            <li class="mb-2 d-flex custom-fs-14 align-items-center"><a href="#" class="text-white"> Image </a></li>
                            <li class="mb-2 d-flex custom-fs-14 align-items-center"><a href="#" class="text-white">Video </a></li>

                        </ul>
                    </div>
                    @php
                    $social=DB::connection('mysql2')->table('websites')->first();
                @endphp
                <div class="col-lg-2 col-6">
                    <h5 class="custom-text-dark mb-3 custom-fs-14 text-uppercase">Contact ifno</h5>
                    <ul class="custom-fs-12 footer-ul">
                        <li class="mb-2 d-flex custom-fs-14 align-items-center"><i class="fas fa-envelope mr-2"></i><a href="#" class="text-white"> &nbsp; {{ $social->email}}</a></li>
                        <li class="mb-2 d-flex custom-fs-14 align-items-center"><i class="fas fa-phone-alt mr-2"></i><a href="#" class="text-white">&nbsp; {{ $social->phone}}</a></li>

                        <li class="mb-2 d-flex custom-fs-14 align-items-center"><i class="fas fa-map-marker-alt mr-2"></i><a href="#" class="text-white">&nbsp;&nbsp; {{ $social->address}}</a></li>
                    </ul>
                </div>

<div class="col-lg-2 col-6">
    <h5 class="custom-text-dark mb-3 custom-fs-14 text-uppercase">Office Address</h5>

    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14302.438586353122!2d87.043413!3d26.3391367!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5343632e81073a08!2sJajbashop!5e0!3m2!1sen!2snp!4v1635300958556!5m2!1sen!2snp" width="100%" height="100" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>





                    </div>
                </div>
                
            </div>
        </div>
    </section>
   
</div>