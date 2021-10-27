<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS  -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/owl.carousel.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css')}}">
    <title>JAJBASHOP</title>
  
</head>

<body class="custom-bg-gray">

  @include('frontend.includes.sidenav')

    <!-- Header Section  -->
  @include('frontend.includes.header')
   
    <!-- Carousel SM  -->
    @include('frontend.includes.category')
  {{-- main content  --}}

  @yield('content')
    <!-- Footer Section  -->
  @include('frontend.includes.footer')
   
    <!-- JS  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('frontend/assets/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('frontend/js/main.js')}}"></script>
</body>

</html>