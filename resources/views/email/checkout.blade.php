<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

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

        <?php
       $web=DB::table('websites')->first();
       $order=DB::table('orders')->where('id',$order_id)->first();
       $ship=DB::table('shippings')->where('order_id',$order_id)->first();
       $cart=DB::table('order_details')->join('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','order_details.product_id')->select('jajbashop_ecommerce.products.name','jajbashop_ecommerce.products.image','order_details.*','order_details.gst')->where('order_id',$order_id)->get();

       if($order->seller==4){
         $seller=DB::table('websites')->first();
         $seller->name='Jajbashop';
     }elseif($order->seller==3){
         $seller=DB::table('supers')->where('id',__getSuper()->id)->first();
     }elseif($order->seller==2){
         $seller=DB::table('distributors')->where('id',__getDist()->id)->first();
     }else{

     }
            ?>

        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title ">
                              <a href="https://jajbashop.in" class='add' >
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
                                {{-- &nbsp;&nbsp;{{$web->address}} --}}

                                     </div>
                          </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

     

          <tr class="information" style='text-align:left!important;'>
                   <td colspan='2'>

                                  <div class="invoice">
                                   <h3>Bill From</h3>

                                    Invoice #:{{$order->order_id}}<br />

                                  {{\Carbon\Carbon::parse($order->created_at)->format('d M Y')}}
                                   <br>
                                   {{$seller->name}}
                                   <br>
                                   {{$seller->email}}
                                   <br>
                                    {{$seller->phone}}
                                  </div>
                               </td>


                                <td colspan='2'>
                               <div class="bill" style='margin-left:6rem!important;'>
                                   <h3>Bill To</h3>
                               {{$ship->name}}
                               <br>
                                  {{$ship->email}}
                                   <br>
                                   {{$ship->phone}}
                                      <br>
                                   {{$ship->city}},
                                   {{$ship->district}},
                                   {{$ship->state}}

                                   </div>
                               </td>

               </tr>
                <tr  style='text-align:center!important;'>
                    <td colspan='4'><strong>HERE’S YOUR ORDER SUMMARY</strong></td>
                    </tr>
                 <tr class="heading" >
                   <td > Item</td>
                     <td> Quantity</td>
                     <td> GST (%)</td>

                       <td>Unit Price {{__getPriceunit()}}</td>

                         <td>Total Price</td>


               </tr>


  <?php $grandtotal=0; 
   foreach ($cart as $item){
 

       $grandtotal +=$item->price*$item->qty;

   ?>
               <tr class="item" >
                   <td>  {{$item->name}}
                   </td>

                   <td>   {{$item->qty}}</td>
                   <td>   {{$item->gst}}</td>

                    <td>  {{number_format((float)$item->price,2)}}</td>
                     <td>     {{number_format((float)$item->qty *$item->price,2)}}</td>
                     <td></td>
                        <td></td>   <td></td>   <td></td>   <td></td>
               </tr>
              <?php }?>

               <tr class="total" style='text-align:left!important;'>

                   <td colspan='5'>

                   <div class="padding">
                   Total : {{__getPriceunit()}} {{ number_format($grandtotal,2)}}
                   <br>
                   Payment Mode : {{$order->payment_mode}}


                   </div>
                       </td>

               </tr>

 </table>
    </div>
</body>

</html>