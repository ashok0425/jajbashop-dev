<!DOCTYPE html>
<html>

<head>

    <style>

        body{
            padding:0;
            margin:0;
            box-sizing:border-box;
             font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            box-shadow: 0 0 10px rgb(14, 13, 13);
            font-size: 16px;
            line-height: 24px;
            color: #000;
         padding-left:30px;
         padding-right:30px;
            background: #fff;
         padding-bottom:2rem;


        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            box-shadow: 0 0 10px rgb(14, 13, 13);

        }

        .invoice-box table td {
            padding: 8px 0;
            vertical-align: top;
        }
        .padding{
            padding-left:400px;
        }


        .invoice-box table tr.top table td {
            padding-bottom: 30px;
        }



        .invoice-box table tr.information table td {
            padding-bottom: 70px;
        }

        .invoice-box table tr.heading td {
            border-bottom: 2px solid #005aa6;
            font-weight: bold;

padding-top: 1rem;
padding-bottom: 1rem;


        }

        .invoice-box table tr.details td {
            border-bottom: 2px solid gray;

            padding-bottom: 20px;
        }
        .invoice-box table tr.details td:last-child {


            padding-bottom: 20px;
        }



        .invoice-box table tr.total td {
            border-top: 2px solid #005aa6;
            border-bottom: 2px solid #005aa6;

        }


        /** RTL **/

        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
        .add{
            font-size: 20.5px;
            margin: 0!important;
            padding-left: -60px!important;
            line-height: 1.3;
            font-weight:0!important;
        }

        .bill h3,.invoice h3{
            color:#005aa6;
            font-size: 1.8rem;
            font-weight: 700;
        }
       .bill{
           padding-left:3rem!important;
       }

.border_bottom{
    width: 107.5%;
    height: 80px;
    background: #d2a758;
    margin-left: -30px;

}
.links{
    padding:20px 100px;
}
.links a{

   margin-left:20px;
    margin-right:20px;
    color:#fff;
    text-decoration:none;
}

.add img{
    max-width: 300px;
}
@media only screen and (max-width: 600px) {
            .padding{
            padding-left:0px;
        }
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            .border_bottom{
           display: none!important;

}
.add img{
    max-width: 200px!important;
}
.information{
    padding: 0 3px!important;
}
.invoice-box{
    padding-left:10px;
         padding-right:10px;
         padding-bottom:2rem;
         width: 100%!important;
         margin:0!important;
}
        }
    </style>
</head>

<body>
    <div class="invoice-box">

        @php
        $web=DB::table('websites')->first();

    @endphp
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title ">
                              <a href="{{route('/')}}" class='add' >
                                    <img src="{{ asset('logo.png') }}"  style="width: 110px!important;"/>
                              </a>
                          <div class="text">


                            <div class='add'>
                                &nbsp;&nbsp;{{$web->phone}}

                                     </div>
                              <div class='add'>
                                &nbsp;&nbsp; <a href="mailto::{{$web->email}}" style="color:#000;">{{$web->email}}</a>

                              </div>
                              <div class='add'>
                                &nbsp;&nbsp;{{$web->address}}

                                     </div>
                          </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            @yield('content')
        </table>

</body>

</html>
