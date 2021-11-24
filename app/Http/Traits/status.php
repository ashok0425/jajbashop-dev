<?php
namespace App\Http\Traits;

use App\Models\User;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\Level;
use App\Models\Order_detail;
use App\Models\Shipping;
use App\Models\Vouchergift;
use File;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
trait status
{

    protected function active($id,$table){
        DB::table($table)->where('id',$id)->update([
             'status'=>1,
         ]);
         $notification=array(
             'alert-type'=>'info',
             'messege'=>'Status Activated',

          );
          return redirect()->back()->with($notification);
     }

     protected function deactive($id,$table){
        DB::table($table)->where('id',$id)->update([
            'status'=>0,
        ]);
        $notification=array(
            'alert-type'=>'info',
            'messege'=>'Status Deactivated',

         );
         return redirect()->back()->with($notification);
    }


    protected function destroy($id,$table){
      $image=DB::table($table)->where('id',$id)->value('image');
      if($image){
          File::delete($image);
      }
      DB::table($table)->where('id',$id)->delete();

        $notification=array(
            'alert-type'=>'success',
            'messege'=>'Sucessfull deleted',

         );
         return redirect()->back()->with($notification);
    }



    public function orderPush($orderId,$total,$comission,$bv,$payment_mode,$sale,$buyer,$seller,$seller_id,$buyer_id,$ship){
        $order=new Order;
        $order->user_id=$buyer_id;
        $order->seller_id=$seller_id;
        $order->total=$total;
        $order->bv=$bv;
        $order->comission=$comission;
        $order->payment_mode=$payment_mode;
        $order->payment_id=rand();
        $order->order_id=$orderId;
        $order->buyer=$buyer;
        $order->seller=$seller;
        if($order->save()){
          $shiping=new Shipping;
          $shiping->name=$ship->name;
          $shiping->email=$ship->email;
          $shiping->phone=$ship->phone;
          $shiping->state=$ship->state;
          $shiping->district=$ship->district;
          $shiping->city=$ship->city;
          $shiping->pincode=$ship->pincode;
          $shiping->order_id=$order->id;
           $shiping->save();
        //   storing cart item
       foreach ($sale as  $item) {
$gst=DB::connection('mysql2')->table('gsts')->where('id',$item->hsn_id)->value('percent');
          $orderdetail=new Order_detail;
          $orderdetail->order_id=$order->id;
          $orderdetail->product_id=$item->product_id;
          $orderdetail->price=$item->price;
          $orderdetail->qty=$item->qty;
          $orderdetail->bv=$item->bv;
          $orderdetail->gst=$gst;

          if ($seller==4) {
            $orderdetail->comission=(($item->price*$item->sc)/100);

          }elseif($seller==3){
          $orderdetail->comission=(($item->price*$item->dc)/100);

          }else{

          }
          $orderdetail->save();
         }
      

            //    Decreasing all item from inventory
       foreach ($sale as $item) {
        $check=Inventory::where('user_id',$seller_id)->where('product_id',$item->product_id)->where('buyer',$seller)->first();
        if($check){
       $inventory=Inventory::find($check->id);
        $inventory->qty=$check->qty-$item->qty;
        $inventory->save();
     
    }
  }
       
      //    storing all cart item to inventory
       foreach ($sale as $item) {
           $check=Inventory::where('user_id',$buyer_id)->where('product_id',$item->product_id)->where('buyer',$buyer)->first();
           if($check){
          $inventory=Inventory::find($check->id);
           $inventory->qty=$item->qty+$check->qty;
           $inventory->price=$item->price;
           $inventory->save();
           }else{
            $inventory=new Inventory;
            $inventory->user_id=$buyer_id;
            $inventory->qty=$item->qty;
            $inventory->price=$item->price;
            $inventory->product_id=$item->product_id;
            $inventory->buyer=$buyer;
            $inventory->seller=$seller;
            $inventory->save();
           }
       }
      //    loading pdf
       $set=[
        'order_id'=>$order->id,
        'email'=>$ship->email,
        'orderId'=>$order->order_id,
        'date'=>$order->created_at,
      ];  
      

       // calculation total monthly bv of member 
       if($buyer==1){
        $this->monthlybv($buyer_id);
       }

      //  $pdf = PDF::loadView('email.checkout', $set);
      //  $sale=DB::table('salescarts')->where('user_id',__getSuper()->id)->where('seller',3)->delete();
         
      // // sending email
      //  Mail::send('email.order', $set, function($message)use($set, $pdf) {
      //      $message->to($set['email'])
      //              ->subject("Thank you for your order. Your order number has been placed.")
      //              ->attachData($pdf->output(), "orderinvoice.pdf");
      //  });
      
        }
      
        
      }

       // calculation total monthly bv of member 
      public function monthlybv($id){
        // Total 100 voucher order place 
        $vouchersend=Vouchergift::where('Isvoucher',0)->where('user_id',$id)->get()->count();
    $monthlybv=Order::where('user_id',$id)->where('buyer',1)->whereMonth('created_at',date('m'))->sum('bv');

    if($vouchersend<=6&&$monthlybv>=250){
     $gift=Vouchergift::whereMonth('created_at',date('m'))->where('user_id',$id)->where('Isvoucher',0)->first();
     if(!$gift){
       $insertGift=new Vouchergift;
       $insertGift->user_id=$id;
       $insertGift->Isvoucher=0;
       $insertGift->voucher=100;
       $insertGift->save();
     }
    }
   
    // Total 500 voucher order place 
    $vouchersend=Vouchergift::where('Isvoucher',1)->where('user_id',$id)->get()->count();

    // if this member have four direct chile 
    $userid=User::where('id',$id)->value('userid');
    $four_member=Level::where('l1', $userid)->get()->count();
      if($vouchersend<=8&&$four_member>=4){

    if($monthlybv>=500){
      $gift=Vouchergift::whereMonth('created_at',date('m'))->where('Isvoucher',1)->where('user_id',$id)->first();
     if(!$gift){
       $insertGift=new Vouchergift;
       $insertGift->user_id=$id;
       $insertGift->Isvoucher=1;
       $insertGift->voucher=500;
       $insertGift->save();
     }
    }
      }
    }

}
