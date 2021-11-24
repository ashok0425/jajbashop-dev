<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Traits\status;
use App\Models\Order;
use App\Models\Shipping;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use File;
class ReportController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;



    public function dealer()
    {
        $dealer=DB::table('distributors')->where('sponsor_id',__getSuper()->id)->orderBy('id','desc')->get();
       return view('super.report.dealer',compact('dealer'));
    }


    public function buy()
    {
        $product=DB::table('orders')->where('buyer',3)->where('user_id',__getSuper()->id)->orderBy('id','desc')->get();
       return view('super.report.buy',compact('product'));
    }


    public function sale()
    {
        $product=DB::table('orders')->where('seller',3)->where('seller_id',__getSuper()->id)->get();
       return view('super.report.sale',compact('product'));
    }




    public function show($id,$orderId)
    {
        try {
            //code...
      
       $order=Order::where('id',$id)->where('order_id',$orderId)->first();
       if($order->user_id==__getSuper()->id||$order->seller_id==__getSuper()->id){
        $ship=Shipping::where('order_id',$id)->first();
        $product=DB::table('order_details')->join('orders','orders.id','order_details.order_id')->join('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','order_details.product_id')->where('order_details.order_id',$id)->select('alfacode_jajbashop_ecommerce.products.name','alfacode_jajbashop_ecommerce.products.image','alfacode_jajbashop_ecommerce.products.id as pid','order_details.*')->orderBy('order_details.id','desc')->get();
       return view('super.report.show',compact('product','ship','orderId','id'));
    }else{
        $notification=array(
            'alert-type'=>'error',
            'messege'=>'Something went wrong.Try again later',
        
         );
        return redirect()->back()->with($notification);
    }
} catch (\Throwable $th) {
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Something went wrong.Try again later',
    
     );
    return redirect()->back()->with($notification);
}

    }


//    loading pdf

    public function download($id,$orderId){      
   
    try {
    $order=Order::where('id',$id)->where('order_id',$orderId)->first();
    if($order->user_id==__getSuper()->id||$order->seller_id==__getSuper()->id){
        $set=[
            'order_id'=>$id,
        ];
    $pdf = PDF::loadView('super.report.download', $set);
    return $pdf->download('invoice.pdf');

}else{
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Something went wrong.Try again later',
    
     );
        return redirect()->back()->with($notification);
    }

    } catch (\Throwable $th) {
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Something went wrong.Try again later',

    );
    return redirect()->back()->with($notification);
    }


    }

// print report 
    public function print($id){
        $orderId=$id;
        return view('super.report.print',compact('orderId'));
        }
}
