<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RepurchaseController extends Controller
{




      public  function selfBv(){
        $income=Order::where('buyer',1)->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('member.repurchase.selfbv',compact('income'));

    }

    public  function selfComission(){
      $income=Order::where('buyer',1)->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
      return view('member.repurchase.selfcomm',compact('income'));

}

public function teamBv(){
   $income=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where(function($level){
            $level->where('levels.l1',Auth::user()->userid)->orwhere('levels.l2',Auth::user()->userid)->orwhere('levels.l3',Auth::user()->userid)->orwhere('levels.l4',Auth::user()->userid)->orwhere('levels.l5',Auth::user()->userid)->orwhere('levels.l6',Auth::user()->userid)->orwhere('levels.l7',Auth::user()->userid)->orwhere('levels.l8',Auth::user()->userid)->orwhere('levels.l9',Auth::user()->userid)->orwhere('levels.l10',Auth::user()->userid);
          })->select('levelbvs.l1 as el1','levelbvs.l2 as el2','levelbvs.l3 as el3','levelbvs.l4 as el4','levelbvs.l5 as el5','levelbvs.l6 as el6','levelbvs.l7 as el7','levelbvs.l8 as el8','levelbvs.l9 as el9','levelbvs.l10 as el10','levelbvs.created_at as created','levels.*')->get();
          return view('member.repurchase.teambv',compact('income'));

}

public function teamComission (){
  $income=DB::table('levels')->join('levelcomissions','levelcomissions.user_id','levels.user_id')->where(function($level){
           $level->where('levels.l1',Auth::user()->userid)->orwhere('levels.l2',Auth::user()->userid)->orwhere('levels.l3',Auth::user()->userid)->orwhere('levels.l4',Auth::user()->userid)->orwhere('levels.l5',Auth::user()->userid)->orwhere('levels.l6',Auth::user()->userid)->orwhere('levels.l7',Auth::user()->userid)->orwhere('levels.l8',Auth::user()->userid)->orwhere('levels.l9',Auth::user()->userid)->orwhere('levels.l10',Auth::user()->userid);
         })->select('levelcomissions.l1 as el1','levelcomissions.l2 as el2','levelcomissions.l3 as el3','levelcomissions.l4 as el4','levelcomissions.l5 as el5','levelcomissions.l6 as el6','levelcomissions.l7 as el7','levelcomissions.l8 as el8','levelcomissions.l9 as el9','levelcomissions.l10 as el10','levelcomissions.created_at as created','levels.*')->get();
         return view('member.repurchase.teamcomm',compact('income'));

}



public function levelbv(){
         return view('member.repurchase.levelbv');
}

public  function levelbvshow($id){
  $income=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l'.$id,Auth::user()->userid)->select('levelbvs.user_id')->groupBy('levelbvs.user_id')->get();

  return view('member.repurchase.levelbvshow',compact('income','id'));

}



}

