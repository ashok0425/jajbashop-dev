<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invoice</title>

    <style>

        body{
            padding:0;
            margin:0;
            box-sizing:border-box;
             max-width:80%important;
             margin: auto;
              font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }


        table {

             margin:auto;
            line-height: inherit;
            text-align: center;
        }

  table td {
            padding: 8px 0;
            vertical-align: top;
        }
        .padding{
            padding-left:400px;
        }


        table tr.top table td {
            padding-bottom: 30px;
        }



     table tr.information table td {
            padding-bottom: 70px;
        }

        table tr.heading td {
            border-bottom: 2px solid #005aa6;
            font-weight: bold;

padding-top: 1rem;
padding-bottom: 1rem;
padding-left:0;
padding-right:0;
        }

        table tr.details td {
            border-bottom: 2px solid gray;

            padding-bottom: 20px;
        }
         table tr.details td:last-child {


            padding-bottom: 20px;
        }



        table tr.total td {
            border-top: 2px solid #005aa6;
            border-bottom: 2px solid #005aa6;

        }

        @media only screen and (max-width: 600px) {
            .padding{
            padding-left:0px;
        }
           table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }

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


.border_bottom{
    width:120%;
    position:fixed;
    bottom:-50px;
    height:80px;
    background:#005aa6;
    padding:0;
    left:-100px;
    margin:0;

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

    </style>



</head>
<body>


    <?php
    $web=DB::table('websites')->first();
    $order=DB::table('orders')->where('id',$order_id)->first();

    $ship=DB::table('shippings')->where('order_id',$order_id)->first();
    $cart=DB::table('order_details')->join('products','products.id','order_details.product_id')->select('products.name','products.image','order_details.*')->where('order_id',$order_id)->get();

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
                                <h3>Bill to</h3>
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
                    <td>Unit Price</td>

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
                 <td> {{__getPriceunit()}} {{number_format((float)$item->price,2)}}</td>
                  <td>    {{__getPriceunit()}} {{number_format((float)$item->qty *$item->price,2)}}</td>
                  <td></td>
                     <td></td>   <td></td>   <td></td>   <td></td>
            </tr>
           <?php }?>

            <tr class="total" style='text-align:left!important;'>

                <td colspan='5'>

                <div class="padding">
                Total : {{__getPriceunit()}} {{ number_format($grandtotal,2)}}

                </div>
                    </td>

            </tr>

</table>


                        <h4 style="margin-left:10%;">
        Please do not hesitate to reach us at  <a href='tel:9818212439'>{{$web->phone}}</a> or

            <a href='mailto:{{$web->email}}'>{{$web->email}}</a>
        if you have any questions or queries.
</h4>



</body>
</html>
