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
use App\Models\Levelearning;
use App\Models\Mycomission;
use Illuminate\Support\Facades\Mail;
class SaleController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;

    public function create()
    {
        $product=DB::table('inventories')->leftjoin('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','inventories.product_id')->where('inventories.buyer',2)->where('inventories.user_id',__getDist()->id)->select('jajbashop_ecommerce.products.name','jajbashop_ecommerce.products.image','jajbashop_ecommerce.products.id as pid','inventories.*')->orderBy('inventories.id','desc')->get();

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
        $sales=DB::table('salescarts')->join('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','salescarts.product_id')->select('jajbashop_ecommerce.products.name','salescarts.*','products.bv')->where('salescarts.seller',2)->where('salescarts.user_id',__getDist()->id)->get();
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


    //  checking whether the Member is available or not
    $check=User::where('userid',$request->userid)->orwhere('phone',$request->userid)->first();
    if(!$check){
  $notification=array(
      'alert-type'=>'error',
      'messege'=>'No  User/member find with this given data',

   );
  return redirect()->back()->with($notification);
    }

    $id=$check->id;

    // try {
        //code...
        $sale=DB::table('salescarts')->join('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','salescarts.product_id')->select('salescarts.*','jajbashop_ecommerce.products.dc','jajbashop_ecommerce.products.bv')->where('salescarts.seller',2)->where('salescarts.user_id',__getDist()->id)->get();
    $total=0;
    $bv=0;
    foreach($sale as $item){
        $total+=$item->qty*$item->price;
        $bv+=$item->qty*$item->bv;
    }

    if($request->payment_mode!='voucher'){//cheking whether payment mode is not voucher 
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
    //  for not active user if they are repurchase directly
    if($check->status==null){
        if($userbv->bv>=500){
         $users=User::find($id);
         $users->status='RepurchaseTopup';
         $users->save();

        }else{
            $levelearning=new Levelearning;
            $levelearning->l1=__getrepurchaseprice(1,$bv);
            $levelearning->l2=__getrepurchaseprice(2,$bv);
            $levelearning->l3=__getrepurchaseprice(3,$bv);
            $levelearning->l4=__getrepurchaseprice(4,$bv);
            $levelearning->l5=__getrepurchaseprice(5,$bv);
            $levelearning->l6=__getrepurchaseprice(6,$bv);
            $levelearning->l7=__getrepurchaseprice(7,$bv);
            $levelearning->l8=__getrepurchaseprice(8,$bv);
            $levelearning->l9=__getrepurchaseprice(9,$bv);
            $levelearning->l10=__getrepurchaseprice(10,$bv);
        }
        $comissionbv=0;
    }else{
        // if user is already activated by epin 

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
    // inserting level bv earning so that we can update it later for all level
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

// looping to check and insert bv and comission for all level member for current login member 
for ($i=2; $i <=100 ; $i++) { 
    $levelM='l'.$i;
    $preId=$i-1;
    $prelevel='l'.$preId;
//for level $i2
if(!empty($level->$levelM)){
    __getpercentdata($level->$levelM,$bv,$level->$prelevel,$levelbv,$levelM,$levelcom);
    }
}

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
//    $pdf = PDF::loadView('email.checkout', $set);
//    $sale=DB::table('salescarts')->where('user_id',__getDist()->id)->where('seller',2)->delete();


// // sending email
//    Mail::send('email.order', $set, function($message)use($set, $pdf) {
//        $message->to($set['email'])
//                ->subject("Thank you for your order. Your order number has been placed.")
//                ->attachData($pdf->output(), "orderinvoice.pdf");
//    });

   $notification=array(
    'alert-type'=>'success',
    'messege'=>' Sold Sucessfully.',

 );
return redirect()->back()->with($notification);
    }

// } catch (\Throwable $th) {

//     $notification=array(
//         'alert-type'=>'error',
//         'messege'=>'Something went wrong.Please try again later',

//      );
//     return redirect()->back()->with($notification);
// }

}


public function userdata($data){
    $user=User::where('userid',$data)->orWhere('phone',$data)->first();
    return view('distributor.sales.userdata',compact('user'));
}
 

}


