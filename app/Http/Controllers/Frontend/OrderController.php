<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mail\checkoutmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Ecommerce\Cart;
use GuzzleHttp\Middleware;
use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\order_detail;
use App\Models\Ecommerce\refundorder;
use App\Models\Ecommerce\shipping;
class OrderController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $order = DB::connection('mysql')->table('orders')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
            return view('frontend.order',compact('order'));
        }else{
            $notification=array(
                'messege'=>'Please login first !',
                'alert-type'=>'error'
                 );
            return redirect()->route('login')->with($notification);
        }
    }






    public function show($id,$orderId){
            if(Auth::check()){
                try {
                    //code...
                            $order=Order::where('order_id',$orderId)->where('user_id',Auth::user()->id)->first();
            if(!$order){
                $notification=array(
                    'messege'=>'Sorry,Invalid Order Id',
                    'alert-type'=>'error'
                    );
                return redirect()->route('/')->with($notification);
            }
                $shipping=shipping::where('order_id',$orderId)->first();
                $product=DB::connection('mysql')->table('order_details')->join('products','products.id','order_details.product_id')->select('order_details.*','products.name','products.image')->where('order_details.order_id',$orderId)->get();
                

                return view('frontend.vieworder',compact('order','shipping','product'));
    
            } catch (\Throwable $th) {
                

                $notification=array(
                    'messege'=>'Something went wrong. Please try again later.',
                    'alert-type'=>'error'
                     );
                return redirect()->back()->with($notification);

            }
            	
    
        }
    
    
    }
 
 
    public function orderTrack(Request $request)
    {
        $track=DB::connection('mysql')->table('orders')->where('tracking_code',$request->code)->first();
        if($track){
            return view('frontend.trackorder',compact('track'));

        }else{
            $notification=array(
                'messege'=>'Please insert valid order status key',
                'alert-type'=>'error'
                 );
            return redirect()->back()->with($notification);
        }
    }

   
        
        public function refund(Request $request){
            $request->validate([
                'refund_reason'=>'required'
            ]);
            $userId=Order_detail::where('vendor_order_id',$request->vendor_order_id)->value('user_id');
            $row = DB::connection('mysql')->table('order_details')->where('user_id',Auth::id())->where('vendor_order_id',$request->vendor_order_id)->update(['status'=>5]);
            $refund=new refundorder;
            $refund->order_id=$request->order_id;
            $refund->vendor_order_id=$request->vendor_order_id;
            $refund->order_id=$request->order_id;
            $refund->refund_reason=$request->refund_reason;
            $refund->user_id=$userId;
            $refund->save();
            $notification=array(
                'messege'=>'Refund order request sent',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);
            } 


          //    loading pdf
          public function print($orderId){      
   
            // try {
            $order=Order::where('order_id',$orderId)->first();
            if($order->user_id==Auth::user()->id){
                $set=[
                    'orderId'=>$orderId,
                ];
            // $pdf = PDF::loadView('mail.checkout', $set);
            // return $pdf->download('invoice.pdf');
          return view('mail.checkoutinvoice',compact('orderId'));
        }else{
            $notification=array(
                'alert-type'=>'error',
                'messege'=>'Something went wrong.Try again later',
            
             );
                return redirect()->back()->with($notification);
            }
        
            // } catch (\Throwable $th) {
            // $notification=array(
            //     'alert-type'=>'error',
            //     'messege'=>'Something went wrong.Try again later',
        
            // );
            // return redirect()->back()->with($notification);
            // }
        
        
            }
        


    public function cancel($id,$orderId){
        try {
        Order::where('user_id',Auth::user()->id)->where('order_id',$orderId)->update([
            'status'=>4
        ]);
        Order_detail::where('user_id',Auth::user()->id)->where('order_id',$orderId)->update([
            'status'=>4
        ]);
        
          $notification=array(
                'alert-type'=>'Success',
                'messege'=>'Order Cancelled Sucessfully',
        
            );
            return redirect()->back()->with($notification);
        }

            catch (\Throwable $th) {
                $notification=array(
                    'alert-type'=>'error',
                    'messege'=>'Something went wrong.Try again later',
            
                );
                return redirect()->back()->with($notification);
            }
    }



            
}
