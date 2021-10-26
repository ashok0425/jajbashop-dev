<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;700;900&display=swap" rel="stylesheet">
     {{-- fontawsome  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>ID  Card</title>

    <style>
         .front{
            max-width: 316.8px!important;
     max-height: 211.2px!important;
     margin: auto;
     overflow: hidden;

        }

        .fs-34{
            font-size: 34px!important
        }
        .fs-8{
            font-size: 8px!important
        }
        .fs-12{
            font-size: 12px!important
        }
        .fs-6{
            font-size: 6px!important
        }
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: Roboto;
    }
    .btn{
    background:red;
    padding:8px 25px;
    color:#fff;
    font-weight: 700;
margin-top: 5rem!important;
border-radius: 10px;
}
    @media print {
        body {-webkit-print-color-adjust: exact;
         margin-top: 0!important;
        }
.front{
    max-width: 316.8px!important;
     max-height: 211.2px!important;
     margin: auto;
}
        .btn{
            display: none;
        }

        }
.my{
    margin:5px 0;
}
.sign{
    margin-top: 1px!important;
    width: 120px;
    transform: translate(-20px,-20px);

}
.py-1{
    padding: 3px 0;
}
.fa-star{
    font-size: 12px;
}
    :root {
        --color-blue: #1D9FD9;
        --color-red: #E63E25;
        --color-white: #fff;
        --color-green: #476B45;
        --color-black: #272727;
        --fs-10: 10px; --fs-15: 15px;
        --fs-20: 20px; --fs-25: 25px;
        --fs-30: 30px; --fs-35: 32px;
        --fs-40: 36px;
        --fw-300: 300; --fw-400: 400;
        --fw-500: 500; --fw-600: 600;
        --fw-700: 700; --fw-800: 800;
        --fw-900: 900;
        --br-5: 5px;
        --br-10: 10px;
        --br-15: 15px;
    }

    .fs-10 { font-size: 10px !important; }
    .fs-15 { font-size: 15px !important; }
    .fs-20 { font-size: 20px !important; }
    .fs-25 { font-size: 25px !important; }
    .fs-30 { font-size: 30px !important; }
    .fs-35 { font-size: 35px !important; }
    .fs-40 { font-size: 40px !important; }

    .fw-100 { font-weight: 100 !important; }

    .fw-300 { font-weight: 300 !important; }
    .fw-400 { font-weight: 400 !important; }
    .fw-500 { font-weight: 500 !important; }
    .fw-600 { font-weight: 600 !important; }
    .fw-700 { font-weight: 700 !important; }
    .fw-800 { font-weight: 800 !important; }
    .fw-900 { font-weight: 900 !important; }

    .color-blue { color: var(--color-blue) !important; }
    .color-red { color: var(--color-red) !important; }
    .color-white { color: var(--color-white) !important; }
    .color-green { color: var(--color-green) !important; }
    .color-black { color: var(--color-black) !important; }

    .bg-blue { background-color: var(--color-blue) !important; }
    .bg-red { background-color: var(--color-red) !important; }
    .bg-white { background-color: var(--color-white) !important; }
    .bg-green { background-color: var(--color-green) !important; }
    .bg-black { background-color: var(--color-black) !important; }

    .br-5 { border-radius: var(--br-5) !important; }
    .br-10 { border-radius: var(--br-10) !important; }
    .br-15 { border-radius: var(--br-15) !important; }

    .text-decoration-none {
        text-decoration: none;
    }
    .text-align-center {
        text-align: center;
    }
    .mx-auto {
        margin: auto;

    }
    .font_100{
        font-weight: 100!important;
    }
    .margin-right-4 {
        margin-right: 4rem;
    }
    .margin-left-4 {
        margin-left: 4rem;
    }
    .margin-left-3 {
        margin-left: 3rem;
        transform: translateY(-8px)
    }
    .margin-right-2 {
        margin-right: 1.5rem;
    }
    .margin-top-1 {
        margin-top: .5rem;
    }

    #front-card-navbar {
        display: flex;
        padding:0rem 0;
    }
    #front-card-photo {
        width: 80px;
        height: 80px;
    }

    #fron-card-qr-boundry {
        display: flex;
        justify-content: flex-end;
        margin-top: -6rem;
        margin-bottom: .4rem;
    }
    #front-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0rem 2rem .18rem 2rem;
    }
    #front-card-body {
        padding: 0rem 0;
    }

    .center {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .position-relative {
        position: relative;
    }

    .display-flex {
        display: flex;
    }
    .align-items-center {
        align-items: center;
    }
    .justify-content-center {
        justify-content: center;
    }

    #back-card-body {
        padding: .1rem 0;
    }

    .blue-bar {
        width: 100%;
        height: 30px;
        background-color: var(--color-blue);
        margin: .3rem 0;
    }
    .sub-container {
        width: 100%;
        margin: auto;
    }
</style>
</head>

<body>
    <a href="" onclick="print()" class="btn">Print</a>
    <!-- CARD FRONT PART -->
    <section class="container front">

        <div class="bg-white">
            <div id="front-card-navbar">
                <div class="margin-right-2">
                    <img width="60" height="60" src="{{asset('logo.png')}}" alt="logo" />
                </div>
                <div class=" ">
                    <span class="fs-34 color-blue fw-900">Jajba</span><span class="fs-34 color-red fw-900">Shop</span>
                    <p class="color-green fs-8 margin-left-3">Life Changing Opportunity</p>
                </div>
            </div>
        </div>
        <div class="text-align-center bg-blue py-1">
            <p class="fs-8 color-white ">Jajba Business Communication</p>
            <p class="fs-8 margin-top-1 color-white">Registration no. 10DOGPP0709J2Z5, Add :- Bhimpur, Supaul, Bhiar,
                854339</p>
        </div>
        <div id="front-card-body">
            <div class="display-flex align-items-center">
                <div class="">
                    <div id="front-card-photo" class=" center ">
                       <img src="{{asset($user->profile_photo_path)}}" alt="profile image" width="40">

                    </div>
                    <div class="text-align-center fs-6 sign" >
                        <p>K S Pratap</p>
                        <p>Autho. Signature</p>
                    </div>
                </div>
                <div>
                    <h2 class="fs-12 color-black my-1">ID NO :- {{$user->userid}}</h2>
                    <h2 class="fs-12 color-black my-1">Name :- {{$user->name}}</h2>
                    <h2 class="fs-12 color-black my-1">Aadhar :- {{$user->adhar}}</h2>
                    <h2 class="fs-12 color-black my-1">Mob. No :- {{$user->phone}}</h2>
                </div>
            </div>

            <div id="fron-card-qr-boundry">
                <div id="front-card-qr " class="center">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=80x80&chl={{$user->userid}},{{$user->name}},{{$user->adhar}},{{$user->phone}},{{$user->address}}" alt="">

                </div>
            </div>
        </div>
        <div>
            <div id="front-card-footer" class="bg-blue">
                <a href="#" class="text-decoration-none color-white">
                    <span class="color-white"><i class="fas fa-star"></i></span>
                    <span class="fs-8">शिक्षा</span>
                </a>
                <a href="#" class="text-decoration-none color-white">
                    <span class="color-white"><i class="fas fa-star"></i></span>

                    <span class="fs-8">स्वरोजगार</span>
                </a>
                <a href="#" class="text-decoration-none color-white">
                    <span class="color-white"><i class="fas fa-star"></i></span>

                    <span class="fs-8">बचत</span>
                </a>
            </div>
        </div>
    </section>


    <!-- CARD BACK PART -->
    <section class="container front">
        <div class="blue-bar"></div>
        <div id="back-card-body font_100" class="bg-white">
            <div class="text-align-center">
            <img width="60" height="60" src="{{asset('logo.png')}}" alt="logo" />

            </div>
            <div class="display-flex justify-content-center ">
                <p class="margin-right-2 fs-12 fw-600 color-black">Add :-</p>
                <p class="fs-12 fw-600 color-black">{{$user->address}}</p>
            </div>
            <div class="display-flex justify-content-center margin-top-1 py-1">
                <p class="fs-12 fw-100 color-black text-align-center sub-container">
                    <span>अपने खरीदारी में बचत करें । स्वदेशी अपनायें । से जुड़कर बचत,</span>
                    <br>
                    <span>
                        <span class="fs-12 fw-900 color-red">Jajba</span>
                        <span class="fs-12 fw-900 color-blue">Shop</span>
                    </span>
                    <span>शिक्षा, एवं स्वरोजगार पायें ।</span>
                </p>
            </div>
        </div>
        <div class="blue-bar"></div>
    </section>
    <br>
    <br>
    <br>
</body>

</html>
