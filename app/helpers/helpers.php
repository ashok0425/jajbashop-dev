<?php

use App\Models\Levelbv;
use App\Models\Levelcomission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Userbv;
use App\Models\Repurchasecommision;
use App\Models\RepurchaseTopup;
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

// Get repurchase level topup price 

 function __getlevelprice($level)
{
    $price=DB::table('levelprices')->where('id',$level)->value('price');
    return $price;
}

// calculating vat amount 
function __getVatamount($amount){
    $price=($amount*15)/100;
    return $price;
    }

// calculating vat amount 

function __getadminAmount($amount){
        $price=($amount*10)/100;
    return $price;
        }

// calculating vat amount 

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

    $levelearning=Levelbv::find($levelbv);
    //finding levelbv that was insertterted in order to update
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
    
// Image path from other database
    function __getimagePath($image){
        return 'http://jajbashop.in/'.$image;

    }

    
   //  finding total level income for both admin and member 
    function __getTotalLevelearning($level,$id=null,$levelincome=null){
       if($id==null){ //for admin
         $earning=0;
         for ($i=1; $i <=$level ; $i++) { 
             $earning+=DB::table('levelearnings')->sum('l'.$i);
             
         }
           return $earning;
       }
          else{
 
              if($levelincome==null){
               $earning=0;
               for ($i=1; $i <=$level ; $i++) { 
                    $levels='l'.$i;
                  $earning+=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where("levels.$levels",Auth::user()->userid)->sum("levelearnings.$levels");
                   
               }
                 return $earning;
              }else{
               $earning=0;
               for ($i=2; $i <=$level ; $i++) { 
                    $levels='l'.$i;
                    $earning+=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where("levels.$levels",Auth::user()->userid)->sum("levelearnings.$levels");

               }
                 return $earning;
              }


          }
    }



   //  finding total level income for both admin and member 
   function __getTotalLevelbv($level,$id=null,$levelincome=null){
      if($id==null){ //for admin
        $earning=0;
        for ($i=1; $i <=$level ; $i++) { 
            $earning+=DB::table('levelearnings')->sum('l'.$i);
            
        }
          return $earning;
      }
         else{

             if($levelincome==null){
            $earning=0;

              for ($i=1; $i <=$level; $i++) { 
                   $levels='l'.$i;
                 $earning+=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where("levels.$levels",Auth::user()->userid)->sum("levelbvs.$levels");
              }
              return $earning;

             }else{
              $earning=0;
              for ($i=2; $i <=$level ; $i++) { 
               $levels='l'.$i;
               $earning+=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where("levels.$levels",Auth::user()->userid)->sum("levelbvs.$levels");

                  
              }
                return $earning;
             }


         }
   }





      //  finding total level income for both admin and member 
      function __getTotalrepurchasecomm($level,$id=null,$levelincome=null){
         if($id==null){ //for admin
           $earning=0;
           for ($i=1; $i <=$level ; $i++) { 
               $earning+=DB::table('levelearnings')->sum('l'.$i);
               
           }
             return $earning;
         }
            else{
   
                if($levelincome==null){
                 $earning=0;
                 for ($i=1; $i <=$level ; $i++) { 
                      $levels='l'.$i;
                    $earning+=DB::table('levels')->join('levelcomissions','levelcomissions.user_id','levels.user_id')->where("levels.$levels",Auth::user()->userid)->sum("levelcomissions.$levels");
                       
                 }
                   return $earning;
                }else{
                 $earning=0;
                 for ($i=2; $i <=$level ; $i++) { 
                      $levels='l'.$i;
                      $earning+=DB::table('levels')->join('levelcomissions','levelcomissions.user_id','levels.user_id')->where("levels.$levels",Auth::user()->userid)->sum("levelcomissions.$levels");

   
                     
                 }
                   return $earning;
                }
   
   
            }
      }



// Get repurchase level topup price according to bv purchased by member 
      function __getrepurchaseprice($level,$bv)
      {
          $price=RepurchaseTopup::where('level',$level)->value('percent');
          return $price;
      }