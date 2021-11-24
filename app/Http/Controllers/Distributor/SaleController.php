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
        $product=DB::table('inventories')->leftjoin('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','inventories.product_id')->where('inventories.buyer',2)->where('inventories.user_id',__getDist()->id)->select('alfacode_jajbashop_ecommerce.products.name','alfacode_jajbashop_ecommerce.products.image','alfacode_jajbashop_ecommerce.products.id as pid','inventories.*')->orderBy('inventories.id','desc')->get();

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
        $sales=DB::table('salescarts')->join('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','salescarts.product_id')->select('alfacode_jajbashop_ecommerce.products.name','salescarts.*','products.bv')->where('salescarts.seller',2)->where('salescarts.user_id',__getDist()->id)->get();
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
        // making order id for next order id 
    $prId=Order::orderBy('id','desc')->value('id');
    $orderId=rand().$prId;
    $id=$check->id;
    $payment_mode=$request->payment_mode;
    $seller=2;
    $buyer=1;
    $seller_id=__getDist()->id;
    $buyer_id=$id;
    $ship=$check;
        //code...
        $sale=DB::table('salescarts')->join('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','salescarts.product_id')->select('salescarts.*','alfacode_jajbashop_ecommerce.products.dc','alfacode_jajbashop_ecommerce.products.bv','alfacode_jajbashop_ecommerce.products.hsn_id')->where('salescarts.seller',2)->where('salescarts.user_id',__getDist()->id)->get();

        if(count($sale)<=0){
            $notification=array(
                'messege'=>'No item in cart',
                 'alert-type'=>'error'
             );
            return redirect()->back()->with($notification);
        }
    $total=0;
    $bv=0;
    foreach($sale as $item){
        $total+=$item->qty*$item->price;
        $bv+=$item->qty*$item->bv;
    }

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

    // pushing order 
    $this->orderPush($orderId,$total,0,$bv,'cash',$sale,$buyer,$seller,$seller_id,$buyer_id,$ship);
    DB::table('salescarts')->where('salescarts.user_id',__getDist()->id)->where('seller',2)->delete();
  


// printing invoice on sale 
  return view('distributor.sales.invoice',compact('orderId'));

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


