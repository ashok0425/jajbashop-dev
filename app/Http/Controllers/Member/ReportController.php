<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Traits\status;
use App\Models\Order;
use App\Models\Shipping;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;



    

    public function buy()
    {
        $product=DB::table('orders')->where('buyer',1)->where('user_id',Auth::user()->id)->get();
       return view('member.report.buy',compact('product'));
    }


   



    public function show($id,$orderId)
    
    {
        try {
            //code...
      
       $order=Order::where('id',$id)->where('order_id',$orderId)->first();
       if($order->user_id==Auth::user()->id){
        $ship=Shipping::where('order_id',$id)->first();
        $product=DB::table('order_details')->join('orders','orders.id','order_details.order_id')->join('products','products.id','order_details.product_id')->join('categories','categories.id','products.category_id')->where('order_details.order_id',$id)->select('products.name','products.image','products.id as pid','categories.category','order_details.*','products.gst')->orderBy('order_details.id','desc')->get();
       return view('member.report.show',compact('product','ship','orderId','id'));
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

    public function print($id,$orderId){      
   
    try {
    $order=Order::where('id',$id)->where('order_id',$orderId)->first();
    if($order->user_id==__getSuper()->id||$order->seller_id==__getSuper()->id){
        $set=[
            'order_id'=>$id,
        ];
    $pdf = PDF::loadView('email.checkout', $set);
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



}
