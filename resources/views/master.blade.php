<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
{{-- fontawsome  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Jajbashop Life Changinge Opportunities</title>
    <style>
.navbar{
  background: white;
  color:#fff;
}
.navbar a{
  color:#fff;

}
.dropdown-menu a{
  color: #000;
}
.hero {
  height: 100vh;
  background-image: url(https://images.unsplash.com/photo-1500417148159-68083bd7333a);
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  position: relative;
}
.hero-header {
 position: absolute;
 top: 20%;
 left: 10%;
 transform: -70% -50%;
 color:#fff;
}
.hero-header h1{
  font-weight: bold;
}
li{
    list-style: none;
}
h2{
    font-weight:900;font-family:Roboto;font-size:55px;
}
@media screen and (max-width: 600px){
    h2{
        font-size:33px!important;
    }
    img{
        width:72px!important;
    }
    .ml{
        margin-left:-100px;
        font-size:20px;
    }
}

    </style>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg shadow">
      <div class="container-fluid">
      <a class="navbar-brand d-flex" href="{{route('/')}}"><img src='{{asset('logo.png')}}' width='80' class='img-fluid'>
      <h2> <span class='text-danger ml-2'>Jajba</span><span class='text-info'>Shop</span></h2>
      </a>
      <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fas fa-bars text-info "></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link text-info" href="#">About</a>
          </li>
          <li class="nav-item text-info">
            <a class="nav-link text-info" href="#">Contact</a>
          </li>
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle text-info" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Login
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <!--<a class="dropdown-item" href="{{route('admin.login')}}">Admin Login</a>-->
              <a class="dropdown-item" href="{{route('login')}}">User Login</a>
              <!--{{-- <a class="dropdown-item" href="#">Rider Login</a> --}}-->
            </div>
          </li>

        </ul>

      </div>
    </div>
    </nav>
  @yield('content')


  <footer class="mt-1 bg-info text-white">
      <div class="container py-5">
          <div class="row">
              <div class="col-md-4">
                  <h2>About us</h2>
                 <p>
                     Jajbashop is a company based in Bihar (India).Its main motive is to provide education , employment and saving to all age group.
                 </p>
                 <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d893.9003404185063!2d87.04264753246795!3d26.33940485274862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1633008353318!5m2!1sen!2snp" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

              </div>

              <div class="col-md-4">
                <h2>Useful Links</h2>
               <p>
                   <ul>
                    <li><a href="{{ route('super.login') }}" class="text-white">Super Distributor Login</a></li>
                    <li><a href="{{ route('distributor.login') }}" class="text-white">Distributor Login</a></li>


                       <li><a href="{{ route('/') }}" class="text-white">Member Login</a></li>
                      
                     
                   </ul>
               </p>
            </div>
            <div class="col-md-4">
                <h2>Contact</h2>
               <p>
                   <ul>
                       <li>Email: <a href='mailto:info@jajbashop.in'class='text-white'>info@jajbashop.in</a></li>
                       <li>Phone: <a href='tel:+91-9470858328' class='text-white'>+91-9470858328</a> </li>
                       <li>Address: Bhimpur,Near Thana bhimpur,Supaul,Bihar </li>
                     <li>Pincode: 854339</li>

                   </ul>
               </p>
            </div>
          </div>
      </div>
  </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
  </body>
</html>
