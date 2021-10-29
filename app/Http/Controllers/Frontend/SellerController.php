<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Ecommerce\Sellerreview;
use App\Models\Ecommerce\User;
use App\Models\Ecommerce\Vendordetail;
class SellerController extends Controller
{
   

public function index($id,$name=null){
      $detail=Vendordetail::where('vendor_id',$id)->first();
      if($detail){
        return view('frontend.shop',compact('detail'));

      }else{
    $notification=array(
            'alert-type'=>'error',
            'messege'=>'Seller Hasn\'t thier detail yet..',

         );
         return redirect()->back()->with($notification);
      }

}

// product detail load using ajax 

public function loadDetail($load,$id){


    // try {
        $detail=DB::connection('mysql')->table('users')->where('id',$id)->first();
       
     if($load==1){
         $about=Vendordetail::where('vendor_id',$id)->value('about');
        return view('frontend.ajaxload.seller.about',compact('about'));

     }elseif($load==3){
      
        $rating=Sellerreview::where('seller_id',$id)->join('users','users.id','sellerreviews.user_id')->select('sellerreviews.*','users.name','users.profile_photo_path','users.id as uid')->orderBy('sellerreviews.id','desc')->get();
        $avg=Sellerreview::where('seller_id',$id)->avg('rating');
        $avg1=Sellerreview::where('seller_id',$id)->where('rating',1)->avg('rating');
        $avg2=Sellerreview::where('seller_id',$id)->where('rating',2)->avg('rating');
        $avg3=Sellerreview::where('seller_id',$id)->where('rating',3)->avg('rating');
        $avg4=Sellerreview::where('seller_id',$id)->where('rating',4)->avg('rating');
        $avg5=Sellerreview::where('seller_id',$id)->where('rating',5)->avg('rating');
        return view('frontend.ajaxload.seller.review',compact('rating','id','avg','avg1','avg2','avg3','avg4','avg5'));


    }elseif($load==2){
      
        $seller=User::find($id);
        return view('frontend.ajaxload.seller.info',compact('seller'));

     }
     elseif($load==4){
        $product=DB::connection('mysql')->table('products')->where('vendor_id',$id)->where('status',1)->paginate(24);
        return view('frontend.ajaxload.seller.product',compact('product'));

     }

    // } catch (\Throwable $th) {
    //     $notification=array(
    //         'alert-type'=>'error',
    //         'messege'=>'Something went wrong.Please try again later',

    //      );
    //      return redirect()->back()->with($notification);
    // }
    }
}

