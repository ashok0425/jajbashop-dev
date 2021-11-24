<?php

namespace App\Http\Controllers\Admin\Repurchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use App\Models\Vouchergift;
use App\Models\order_detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;
     
//    fetching  order on the basis of status 
    public function order($status)
    {  
        if($status==7){
            $order=DB::table('vouchergifts')->join('users','users.id','vouchergifts.user_id')->select('vouchergifts.*','users.id as uid','users.name','users.userid')->orderBy('vouchergifts.id','desc')->get();
        }
    else{
        $order=DB::table('vouchergifts')->join('users','users.id','vouchergifts.user_id')->select('vouchergifts.*','users.id as uid','users.name','users.userid')->orderBy('vouchergifts.id','desc')->where('vouchergifts.status',$status)->get();
    }
       return view('admin.repurchase.voucher.order.index',compact('order','status'));
    }

    

    public function changestatus(Request $request)
    {

        $order_id=$request->order_id;
        $voucher=Vouchergift::find($order_id);
        $voucher->status=$request->status_id;
        $voucher->save();
        $notification=array(
            'messege'=>'Status Updated',
             'alert-type'=>'success'
         );

  return redirect()->route('admin.order',['status'=>7])->with($notification);
    }

  



    public function filter(Request $request){
    
        $data="SELECT order_details.*,products.name,products.id as pid,products.image,products.width,products.height,products.length FROM order_details JOIN products ON products.id=order_details.product_id WHERE order_details.created_at BETWEEN '$request->from' AND '$request->to' ";
    
        if(isset($request->vendor) && !empty($request->vendor)){
            $data .="  AND  order_details.vendor_id = '$request->vendor' ";

        }
        if(isset($request->payment_mode) && !empty($request->payment_mode)){
            $data .="  AND  order_details.payment_type = '$request->payment_mode' ";
        }     
      
       
        $status=$request->status;
        $order=DB::select($data);
          return view('backend.order.filter',compact('order','status'));
      
    }
    
        public function pricedetail($id){
        $detail=order_detail::where('vendor_order_id',$id)->first();
        return view('backend.order.pricedetail',compact('detail'));
        }



        public function invoice($orderId,$vendor_order_id){
           return view('mail.checkoutinvoice',compact('orderId','vendor_order_id'));
        }

 


      

     
}
