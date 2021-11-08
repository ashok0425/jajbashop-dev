<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shipping;
use App\Models\Distributor;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use File;
use App\Models\Inventory;
use App\Models\Account;
class ReportController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;



    public function buy()
    {
        $product=DB::table('orders')->where('buyer',2)->where('user_id',__getDist()->id)->get();
       return view('distributor.report.buy',compact('product'));
    }


    public function sale()
    {
        $product=DB::table('orders')->where('seller',2)->where('seller_id',__getDist()->id)->get();
       return view('distributor.report.sale',compact('product'));
    }




    public function show($id,$orderId)
    {
        try {
            //code...
      
       $order=Order::where('id',$id)->where('order_id',$orderId)->first();
       if($order->user_id==__getDist()->id||$order->seller_id==__getDist()->id){

        $ship=Shipping::where('order_id',$id)->first();
        $product=DB::table('order_details')->join('orders','orders.id','order_details.order_id')->join('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','order_details.product_id')->where('order_details.order_id',$id)->select('jajbashop_ecommerce.products.name','jajbashop_ecommerce.products.image','jajbashop_ecommerce.products.id as pid','order_details.*')->orderBy('order_details.id','desc')->get();
       return view('distributor.report.show',compact('product','ship','orderId','id'));
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
    if($order->user_id==__getDist()->id||$order->seller_id==__getDist()->id){
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
