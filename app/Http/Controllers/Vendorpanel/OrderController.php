<?php

namespace App\Http\Controllers\Vendorpanel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use App\Models\Order;
use App\Models\order_detail;
use App\Models\shipping;
use Illuminate\Support\Facades\DB;
use File;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mail\checkout;
use Illuminate\Support\Facades\Mail;
use App\Exports\OrderExport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;
     
//    fetching  order on the basis of status 
    public function order($status)
    {  
        if($status==7){
            $order=DB::table('order_details')->where('order_details.vendor_id',Auth::user()->id)->join('products','products.id','order_details.product_id')->select('order_details.*','products.name','products.id as pid','products.image','products.width','products.height','products.length')->orderBy('order_details.id','desc')->get();
    }elseif($status==5){
        $order=DB::table('order_details')->where('order_details.vendor_id',Auth::user()->id)->join('refundorders','refundorders.vendor_order_id','order_details.vendor_order_id')->join('products','products.id','order_details.product_id')->select('order_details.*','products.name','products.id as pid','products.image','refundorders.refund_reason','products.height','products.length')->orderBy('order_details.id','desc')->get();
        return view('vendorpanel.order.refund',compact('order','status'));
    }
    else{
        $order=DB::table('order_details')->where('order_details.vendor_id',Auth::user()->id)->join('products','products.id','order_details.product_id')->where('order_details.status',$status)->select('order_details.*','products.name','products.id as pid','products.image','products.height','products.length')->orderBy('order_details.id','desc')->get();

    }
       return view('vendorpanel.order.index',compact('order','status'));
    }

    

    public function changestatus(Request $request)
    {
        $order_id=$request->order_id;
        $vendor_order_id=$request->vendor_order_id;
        $status_id=$request->status_id;
         $email=DB::table('shippings')->where('order_id',$order_id)->value('email');
        $order=order_detail::where('order_id',$order_id)->where('vendor_order_id',$vendor_order_id)->where('vendor_id',Auth::user()->id)->first();
        $order->status=$status_id;
        $order->save();

        dd($order->status);

if($status_id==1){
    
$set=[
    'order_id'=>$order_id,
    'ship_email'=>$email,
    'msg'=>"Your order $order->tracking_code is currently being reviewed and will be picked up for delivery soon.",

];

$pdf = PDF::loadView('mail.checkout', $set);
     Mail::send('mail.order', $set, function($message)use($set, $pdf) {
        $message->to($set['ship_email'])
                ->subject("Your order  is currently being reviewed and will be picked up for delivery soon.")
                ->attachData($pdf->output(), "orderinvoice.pdf");
    });
       
}
if($status_id==2){
    $set=[
        'order_id'=>$order_id,
          'ship_email'=>$email,
      'msg'=>"Your order $order->tracking_code is currently on its way to you. One of our representatives will contact you
     soon.",

];
$pdf = PDF::loadView('mail.checkout', $set);
   
    Mail::send('mail.order', $set, function($message)use($set, $pdf) {
        $message->to($set['ship_email'])
                ->subject("Your order is currently on its way to you. One of our representatives will contact you
soon.")
                ->attachData($pdf->output(), "orderinvoice.pdf");
    });
       
}
if($status_id==3){
      $set=[
        'order_id'=>$order_id,
        'ship_email'=>$email,
      'msg'=>"Your order $order->tracking_code has been picked up. Thank you for shopping with us.
    Continue shopping at www.baratodeal.com",

];

    $pdf = PDF::loadView('mail.checkout', $set);
  
    Mail::send('mail.order', $set, function($message)use($set, $pdf) {
        $message->to($set['ship_email'])
                ->subject("Your order  has been picked up. Thank you for shopping with us.
                Continue shopping at www.baratodeal.com")
                ->attachData($pdf->output(), "orderinvoice.pdf");
    });
       
}

if($status_id==4){
    
    
          $set=[
            'order_id'=>$order_id,
            'ship_email'=>$email,
      'msg'=>"Your order $order->tracking_code has been successfully canceled.
    We’re sorry this order didn’t work out for you. But, we hope we’ll see you again later.",

];
 $pdf = PDF::loadView('mail.checkout', $set);
    Mail::send('mail.order', $set, function($message)use($set, $pdf) {
        $message->to($set['ship_email'])
                ->subject("Your order  has been successfully canceled.
                We’re sorry this order didn’t work out for you. But, we hope we’ll see you again later.")
                ->attachData($pdf->output(), "orderinvoice.pdf");
    });
       
}
$notification=array(
            'alert-type'=>'success',
            'messege'=>'status updated',
    
        );
  return response()->back()->with($notification);
    }

  


    public function show($order_id,$vendor_order_id){
    $seller=User::where('id',Auth::user()->id)->first();
    $buyer=shipping::where('order_id',$order_id)->first();
    $item=DB::table('order_details')->join('products','products.id','order_details.product_id')->select('order_details.*','products.name','products.image','products.width','products.weight','products.height','products.length')->where('order_details.order_id',$order_id)->where('vendor_order_id',$vendor_order_id)->first();
    return view('vendorpanel.order.show',compact('buyer','item','seller'));
    }




    public function filter(Request $request){
        $data="SELECT * FROM orders WHERE `status` =$request->status ";
    
        if(isset($request->payment_mode) && !empty($request->payment_mode)){
            $data .="  AND payment_type = '$request->payment_mode' ";
        }     
      
        if(isset($request->to) && !empty($request->to) ||isset($request->from) && !empty($request->from)){
            $data .=" AND   created_at BETWEEN '$request->from' AND '$request->to'";
        }
        $status=$request->status;
        $order=DB::select($data);
          return view('backend.order.filter',compact('order','status'));
      
    }
    
public function pricedetail($id){
$detail=order_detail::where('id',$id)->first();
return view('vendorpanel.order.pricedetail',compact('detail'));
}



        public function invoice($orderId,$vendor_order_id){
        
           return view('mail.checkoutinvoice',compact('orderId','vendor_order_id'));
        }



        public function genertaeLabel(){
           
            $token=generateToken();
            printLabel($token);

        }
}
