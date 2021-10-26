<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;700;900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Visiting Card</title>

    <style>
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
        .btn{
            display: none;
        }

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
    .margin-right-2 {
        margin-right: 1.5rem;
    }
    .margin-top-1 {
        margin-top: .5rem;
    }

    #front-card-navbar {
        display: flex;
        padding: 1rem 0;
    }
    #front-card-photo {
        width: 180px;
        height: 180px;
    }
    #front-card-qr {
        width: 140px;
        height: 140px;
    }
    #fron-card-qr-boundry {
        display: flex;
        justify-content: flex-end;
        margin-top: -8rem;
    }
    #front-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2rem;
    }
    #front-card-body {
        padding: 2rem 0;
    }

    .center {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .container {
        max-width: 840px;
        margin: auto;
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
        height: 60px;
        background-color: var(--color-blue);
        margin: .3rem 0;
    }
    .sub-container {
        width: 80%;
        margin: auto;
    }
</style>
</head>

<body>
    <a href="" onclick="print()" class="btn">Print</a>
    <!-- CARD FRONT PART -->
    <section class="container">
        <div class="bg-white">
            <div id="front-card-navbar">
                <div class="margin-right-4">
                    <img width="80" height="80" src="{{asset('logo.png')}}" alt="logo" />
                </div>
                <div class="text-align-center mx-auto">
                    <img height="80" src="{{asset('b.JPG')}}" alt="logo" />
                </div>
            </div>
        </div>
        <div class="text-align-center bg-blue">
            <br>
            <p class="fs-20 color-white">Jajba Business Communication</p>
            <p class="fs-20 margin-top-1 color-white">Registration no. 10DOGPP0709J2Z5, Add :- Bhimpur, Supaul, Bhiar,
                854339</p>
            <br>
        </div>
        <div id="front-card-body">
            <div class="display-flex align-items-center">
                <div class="margin-right-2">
                    <div id="front-card-photo" class=" center br-15">
                       <img src="{{asset($user->profile_photo_path)}}" alt="profile image" width="150">
                    </div>
                </div>
                <div>
                    <h2 class="fs-25 color-black">ID NO :- {{$user->userid}}</h2>
                    <br>
                    <h2 class="fs-25 color-black">Name :- {{$user->name}}</h2>
                    <br>
                    <h2 class="fs-25 color-black">Aadhar :- {{$user->adhar}}</h2>
                    <br>
                    <h2 class="fs-25 color-black">Mob. No :- {{$user->phone}}</h2>
                </div>
            </div>
            <div class="text-align-center margin-top-1" style="width:160px;-left:0!important ;">
                <p>K S Pratap</p>
                <p>Autho. Signature</p>
            </div>
            <div id="fron-card-qr-boundry">
                <div id="front-card-qr" class="center">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl={{$user->userid}}" alt="">

                </div>
            </div>
        </div>
        <div>
            <div id="front-card-footer" class="bg-blue">
                <a href="#" class="text-decoration-none color-white">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 481 449" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M378.783 448.661C375.415 448.674 372.129 447.625 369.393 445.661L240.783 352.421L112.173 445.661C109.425 447.654 106.115 448.722 102.721 448.709C99.3267 448.697 96.0242 447.605 93.2911 445.593C90.558 443.58 88.5358 440.75 87.517 437.512C86.4981 434.274 86.5352 430.797 87.6231 427.581L137.783 279.011L7.78315 189.861C4.96726 187.932 2.84199 185.154 1.71786 181.931C0.593735 178.708 0.529658 175.21 1.535 171.949C2.54034 168.687 4.5624 165.832 7.30576 163.801C10.0491 161.771 13.37 160.67 16.7832 160.661H177.163L225.563 11.7113C226.606 8.49554 228.64 5.69265 231.375 3.70473C234.109 1.71682 237.403 0.646057 240.783 0.646057C244.164 0.646057 247.457 1.71682 250.192 3.70473C252.926 5.69265 254.961 8.49554 256.003 11.7113L304.403 160.711H464.783C468.201 160.71 471.529 161.802 474.28 163.829C477.032 165.856 479.062 168.71 480.074 171.975C481.086 175.239 481.025 178.741 479.902 181.969C478.779 185.197 476.653 187.98 473.833 189.911L343.783 279.011L393.913 427.541C394.725 429.946 394.954 432.509 394.58 435.02C394.206 437.53 393.239 439.916 391.761 441.979C390.283 444.043 388.335 445.725 386.079 446.887C383.822 448.048 381.321 448.657 378.783 448.661Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>शिक्षा</span>
                </a>
                <a href="#" class="text-decoration-none color-white">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 481 449" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M378.783 448.661C375.415 448.674 372.129 447.625 369.393 445.661L240.783 352.421L112.173 445.661C109.425 447.654 106.115 448.722 102.721 448.709C99.3267 448.697 96.0242 447.605 93.2911 445.593C90.558 443.58 88.5358 440.75 87.517 437.512C86.4981 434.274 86.5352 430.797 87.6231 427.581L137.783 279.011L7.78315 189.861C4.96726 187.932 2.84199 185.154 1.71786 181.931C0.593735 178.708 0.529658 175.21 1.535 171.949C2.54034 168.687 4.5624 165.832 7.30576 163.801C10.0491 161.771 13.37 160.67 16.7832 160.661H177.163L225.563 11.7113C226.606 8.49554 228.64 5.69265 231.375 3.70473C234.109 1.71682 237.403 0.646057 240.783 0.646057C244.164 0.646057 247.457 1.71682 250.192 3.70473C252.926 5.69265 254.961 8.49554 256.003 11.7113L304.403 160.711H464.783C468.201 160.71 471.529 161.802 474.28 163.829C477.032 165.856 479.062 168.71 480.074 171.975C481.086 175.239 481.025 178.741 479.902 181.969C478.779 185.197 476.653 187.98 473.833 189.911L343.783 279.011L393.913 427.541C394.725 429.946 394.954 432.509 394.58 435.02C394.206 437.53 393.239 439.916 391.761 441.979C390.283 444.043 388.335 445.725 386.079 446.887C383.822 448.048 381.321 448.657 378.783 448.661Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>स्वरोजगार</span>
                </a>
                <a href="#" class="text-decoration-none color-white">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 481 449" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M378.783 448.661C375.415 448.674 372.129 447.625 369.393 445.661L240.783 352.421L112.173 445.661C109.425 447.654 106.115 448.722 102.721 448.709C99.3267 448.697 96.0242 447.605 93.2911 445.593C90.558 443.58 88.5358 440.75 87.517 437.512C86.4981 434.274 86.5352 430.797 87.6231 427.581L137.783 279.011L7.78315 189.861C4.96726 187.932 2.84199 185.154 1.71786 181.931C0.593735 178.708 0.529658 175.21 1.535 171.949C2.54034 168.687 4.5624 165.832 7.30576 163.801C10.0491 161.771 13.37 160.67 16.7832 160.661H177.163L225.563 11.7113C226.606 8.49554 228.64 5.69265 231.375 3.70473C234.109 1.71682 237.403 0.646057 240.783 0.646057C244.164 0.646057 247.457 1.71682 250.192 3.70473C252.926 5.69265 254.961 8.49554 256.003 11.7113L304.403 160.711H464.783C468.201 160.71 471.529 161.802 474.28 163.829C477.032 165.856 479.062 168.71 480.074 171.975C481.086 175.239 481.025 178.741 479.902 181.969C478.779 185.197 476.653 187.98 473.833 189.911L343.783 279.011L393.913 427.541C394.725 429.946 394.954 432.509 394.58 435.02C394.206 437.53 393.239 439.916 391.761 441.979C390.283 444.043 388.335 445.725 386.079 446.887C383.822 448.048 381.321 448.657 378.783 448.661Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>बचत</span>
                </a>
            </div>
        </div>
    </section>


    <!-- CARD BACK PART -->
    <section class="container">
        <div class="blue-bar"></div>
        <div id="back-card-body font_100" class="bg-white">
            <div class="text-align-center">
                                   <img width="80" height="80" src="{{asset('logo.png')}}" alt="logo" />

            </div>
            <div class="display-flex justify-content-center ">
                <p class="margin-right-2 fs-25 fw-600 color-black">Add :-</p>
                <p class="fs-25 fw-600 color-black">Chapin, Bhimpur, Chhatapur <br> Supaul, Bihar, 854339</p>
            </div>
            <br>
            <div class="display-flex justify-content-center margin-top-1">
                <p class="fs-35 fw-100 color-black text-align-center sub-container">
                    <span>अपने खरीदारी में बचत करें । स्वदेशी अपनायें । से जुड़कर बचत,</span>
                    <br>
                    <span>
                        <span class="fs-40 fw-900 color-red">Jajba</span>
                        <span class="fs-40 fw-900 color-blue">Shop</span>
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
