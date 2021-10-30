<?php

use App\Models\Levelbv;
use App\Models\Levelcomission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Userbv;
use App\Models\Repurchasecommision;
use Illuminate\Support\Facades\DB;
 function __getAdmin(){
return Auth::guard('admin')->user();
}


function __getSuper(){
    return Auth::guard('super')->user();
    }

    function __getDist(){
        return Auth::guard('distributor')->user();
        }


function __getPriceunit(){
return '₹ ';
}

 function __getlevelprice($level)
{
    $price=DB::table('levelprices')->where('id',$level)->value('price');
    return $price;
}


function __getVatamount($amount){
    $price=($amount*15)/100;
    return $price;
    }

function __getadminAmount($amount){
        $price=($amount*10)/100;
    return $price;
        }


  function __gettdsAmount($amount){
            $price=($amount*5)/100;
            return $price;
            }



            // distribution of bv  
 function __getpercentdata($id,$bv,$prev,$levelbv,$level,$levelcom){
    // *****for level **********
    $user1=User::where('userid',$id)->value('id');
    $pre=User::where('userid',$prev)->value('id');
    if($user1){
        $lbv1=Userbv::where('user_id',$user1)->first();
        $prebv=Userbv::where('user_id',$pre)->first();
              if($lbv1){
            $lbv1->bv=$lbv1->bv+$bv;
            $lbv1->save();
    }else{
          $lbv1=new Userbv;
          $lbv1->bv=$bv;
          $lbv1->user_id=$user1;
          $lbv1->save();
    }
    $finalbv=$lbv1->bv;

    $levelearning=Levelbv::find($levelbv);//finding levelbv that was insertterted in order to update
    $levelearning->$level=$bv;
    $levelearning->save();

    // fetching repurchase comission 
    $prevcomm=Repurchasecommision::where('min_bv','<=',$prebv->bv)->where('max_bv','>=',$prebv->bv)->first();
    $mycomm=Repurchasecommision::where('min_bv','<=',$finalbv)->where('max_bv','>=',$finalbv)->first();
    if($prevcomm->percent-$mycomm->percen!=0){
        $perct=$prevcomm->percent-$mycomm->percent;
        $percent=abs($perct);
        $comission=($bv*$percent)/100;
        $levecomission=Levelcomission::find($levelcom);//finding levelbv that was insertterted in order to update
        $levecomission->$level=$comission;
        $levecomission->save();

    }
  

    }
    
    }
    

    function __getimagePath($image){
        return 'http://ecomm.jajbashop.in/'.$image;

    }