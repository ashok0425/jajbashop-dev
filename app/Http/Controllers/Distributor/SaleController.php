<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Salescart;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Repurchasecommision;
use App\Models\Shipping;
use App\Models\User;
use App\Models\Userbv;
use App\Models\Levelbv;
use App\Models\Level;
use App\Models\Levelcomission;
use App\Models\Mycomission;
use Illuminate\Support\Facades\Mail;
class SaleController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;

    public function create()
    {
        $product=DB::table('inventories')->join('products','products.id','inventories.product_id')->join('categories','categories.id','products.category_id')->select('products.*','categories.category')->where('inventories.buyer',2)->where('inventories.user_id',__getDist()->id)->select('products.name','products.image','products.id as pid','categories.category','inventories.*')->orderBy('inventories.id','desc')->get();
       return view('distributor.sales.create',compact('product'));
    }

// Stroing  product  using ajax like qty and price from inventory

    public function getData($pid){
        $product=DB::table('inventories')->where('buyer',2)->where('user_id',__getDist()->id)->where('id',$pid)->first();
      return response()->json($product);
    }

// Stroing  sales cart item using ajax
    public function store(Request $request){
        $product=Inventory::where('id',$request->product_id)->first();
        $check=DB::table('salescarts')->where('seller',2)->where('user_id',__getDist()->id)->where('product_id',$product->product_id)->first();
        if($check){
        return response()->json("Already Added to Bill");
            
        }else{

        $request->validate([
            'product_id'=>'required',
            'sales_quantity'=>'required',
            'price'=>'required',

        ]);
        $product=Inventory::where('id',$request->product_id)->first();
        $sales = new Salescart;
        $sales->product_id =$product->product_id ;
        $sales->qty = $request->sales_quantity;
        $sales->price = $product->price ;
        $sales->user_id = __getDist()->id;
        $sales->seller = 2;
        $sales->save();
        return response()->json("Added to Bill");

    }

    }

//  sales cart item  using ajax
    public function saleslist(){
        $sales=DB::table('salescarts')->join('products','products.id','salescarts.product_id')->select('products.name','salescarts.*','products.bv')->where('salescarts.seller',2)->where('salescarts.user_id',__getDist()->id)->get();
        return view('distributor.sales.saleslist',compact('sales'));
    }

    // destroy sales cart item 
    public function destroy($id){
        DB::table('salescarts')->where('id',$id)->where('seller',2)->where('user_id',__getDist()->id)->delete();

        return response()->json('Item Deleted');

    }



// storing all the data after checkout
public function checkout(Request $request){
    $request->validate([
        'payment_mode'=>'required',
        'userid'=>'required',
     ]);


    //  checking whether the distributor is available or not
    $check=User::where('userid',$request->userid)->first();
    if(!$check){
  $notification=array(
      'alert-type'=>'error',
      'messege'=>'Sorry,No  User/member find with this given data',

   );
  return redirect()->back()->with($notification);
    }

    $id=$check->id;

    try {
        //code...
        $sale=DB::table('salescarts')->join('products','products.id','salescarts.product_id')->select('salescarts.*','products.dc','products.bv')->where('salescarts.seller',2)->where('salescarts.user_id',__getDist()->id)->get();
    $total=0;
    $bv=0;
    foreach($sale as $item){
        $total+=$item->qty*$item->price;
        $bv+=$item->qty*$item->bv;
    }
    if($request->payment_mode!='voucher'){//cking whether payment mode is not voucher
        
     //storing or updating bv to userbv table 
    $userbv=Userbv::where('user_id',$id)->first();
    if($userbv){
            $userbv->bv=$userbv->bv+$bv;
            $userbv->save();
    }else{
          $userbv=new Userbv;
          $userbv->bv=$bv;
          $userbv->user_id=$id;
          $userbv->save();

    }
    $finalbv=$userbv->bv;
    // fetching repurchase comission 
    $maincomission=Repurchasecommision::where('min_bv','<=',$finalbv)->where('max_bv','>=',$finalbv)->first();
    $comissionbv=($bv*$maincomission->percent)/100;
    $mycomm=Mycomission::where('user_id',$id)->first();

    if($mycomm){
      $mycomm->comission= $mycomm->comission+$comissionbv;
      $mycomm->save();
    }else{
        $mycomm=new Mycomission;
        $mycomm->user_id=$id;
      $mycomm->comission= $comissionbv;
      $mycomm->save();

    }
    // inserting level bv earning 
    $levelearning=new Levelbv;
    $levelearning->user_id=$id;
    $levelearning->save();
   $levelbv=$levelearning->id;

  // inserting level bv earning 
  $levelcomission=new Levelcomission();
  $levelcomission->user_id=$id;
  $levelcomission->save();
 $levelcom=$levelcomission->id;

    // fetching all above level member upto 13 lvel in order to distribute comission
    $level=Level::where('user_id',$id)->first();
   

//for level 1 
if(!empty($level->l1)){
    __getpercentdata($level->l1,$bv,$check->userid,$levelbv,'l1',$levelcom);
}

//for level 2
if(!empty($level->l2)){
__getpercentdata($level->l2,$bv,$level->l1,$levelbv,'l2',$levelcom);
}
//for level 3
if(!empty($level->l3)){
__getpercentdata($level->l3,$bv,$level->l2,$levelbv,'l3',$levelcom);
}
//for level 4
if(!empty($level->l4)){
__getpercentdata($level->l4,$bv,$level->l3,$levelbv,'l4',$levelcom);
}
//for level 5
if(!empty($level->l5)){
__getpercentdata($level->l5,$bv,$level->l4,$levelbv,'l5',$levelcom);
}
//for level 6
if(!empty($level->l6)){
__getpercentdata($level->l6,$bv,$level->l5,$levelbv,'l6',$levelcom);
}
//for level 7
if(!empty($level->l7)){
__getpercentdata($level->l7,$bv,$level->l6,$levelbv,'l7',$levelcom);
}
//for level 9
if(!empty($level->l8)){
__getpercentdata($level->l8,$bv,$level->l7,$levelbv,'l8',$levelcom);
}
//for level 9
if(!empty($level->l9)){
__getpercentdata($level->l9,$bv,$level->l8,$levelbv,'l9',$levelcom);
}
//for level 10
if(!empty($level->l10)){
__getpercentdata($level->l10,$bv,$level->l9,$levelbv,'l10',$levelcom);
}
//for level 11
if(!empty($level->l11)){
__getpercentdata($level->l11,$bv,$level->l10,$levelbv,'l11',$levelcom);
}
//for level 12
if(!empty($level->l12)){
__getpercentdata($level->l12,$bv,$level->l11,$levelbv,'l12',$levelcom);
}
//for level 13
if(!empty($level->l13)){
__getpercentdata($level->l13,$bv,$level->l12,$levelbv,'l13',$levelcom);
}
//for level 14
if(!empty($level->l4)){
__getpercentdata($level->l14,$bv,$level->l13,$levelbv,'l14',$levelcom);
}
//for level 15
if(!empty($level->l5)){
__getpercentdata($level->l15,$bv,$level->l14,$levelbv,'l15',$levelcom);
}


       



    }

    $order=new Order;
    $order->user_id=$id;
    $order->seller_id=__getDist()->id;
    $order->total=$total;
    $order->bv=$bv;
    $order->comission=$comissionbv;//this comission bv on current repurchase of member
    $order->payment_mode=$request->payment_mode;
    $order->payment_id=rand();
    $order->order_id='JS'.uniqid();
    $order->buyer=1;
    $order->seller=2;
    if($order->save()){
      $ship=new Shipping;
      $ship->name=$check->name;
      $ship->email=$check->email;
      $ship->phone=$check->phone;
      $ship->state=$check->state;
      $ship->district=$check->district;
      $ship->city=$check->city;
      $ship->pincode=$check->pincode;
      $ship->order_id=$order->id;
      $ship->save();

    //   storing cart item
   foreach ($sale as  $item) {
      $orderdetail=new Order_detail;
      $orderdetail->order_id=$order->id;
      $orderdetail->product_id=$item->product_id;
      $orderdetail->price=$item->price;
      $orderdetail->qty=$item->qty;
      $orderdetail->bv=$item->bv;
      $orderdetail->comission=$item->dc;
      $orderdetail->save();
     }

   //    updating inventory of login user
   foreach ($sale as $item) {
    $check=DB::table('inventories')->where('user_id',__getDist()->id)->where('product_id',$item->product_id)->where('buyer',2)->first();
    $inventory=Inventory::find($check->id);
    $inventory->qty=$inventory->qty-$item->qty;
    $inventory->save();
    }

//    loading pdf
   $set=[
    'order_id'=>$order->id,
    'email'=>$ship->email,
    'orderId'=>$order->order_id,
    'date'=>$order->created_at,
];
   $pdf = PDF::loadView('email.checkout', $set);
   $sale=DB::table('salescarts')->where('user_id',__getDist()->id)->where('seller',2)->delete();


// sending email
   Mail::send('email.order', $set, function($message)use($set, $pdf) {
       $message->to($set['email'])
               ->subject("Thank you for your order. Your order number has been placed.")
               ->attachData($pdf->output(), "orderinvoice.pdf");
   });

   $notification=array(
    'alert-type'=>'success',
    'messege'=>' Sold Sucessfully.',

 );
return redirect()->back()->with($notification);
    }

} catch (\Throwable $th) {

    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Something went wrong.Please try again later',

     );
    return redirect()->back()->with($notification);
}

}


public function userdata($data){
    $user=User::where('userid',$data)->orWhere('phone',$data)->first();
    return view('distributor.sales.userdata',compact('user'));
}
 

}


