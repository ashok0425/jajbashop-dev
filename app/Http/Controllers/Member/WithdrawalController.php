<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Withdrawal;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class WithdrawalController extends Controller
{


    public  function pending(){
        $withdrawal=DB::table('withdrawals')->join('users','users.id','withdrawals.user_id')->where('user_id',Auth::user()->id)->where('withdrawals.status',0)->select('users.name','users.userid','withdrawals.*')->get();
        return view('member.withdrawal.pending',compact('withdrawal'));
    }

    public  function rejected(){
        $withdrawal=DB::table('withdrawals')->join('users','users.id','withdrawals.user_id')->where('user_id',Auth::user()->id)->where('withdrawals.status',1)->select('users.name','users.userid','withdrawals.*')->get();
        return view('member.withdrawal.rejected',compact('withdrawal'));
    }

    public  function accepted(){
        $withdrawal=DB::table('withdrawals')->join('users','users.id','withdrawals.user_id')->where('user_id',Auth::user()->id)->where('withdrawals.status',2)->select('users.name','users.userid','withdrawals.*')->get();
        return view('member.withdrawal.approved',compact('withdrawal'));
    }




public  function create(){
    return view('member.withdrawal.request');
}



public function store(Request $request){//update profile of memeber
    $request->validate([
        'remark'=>'required',
        'amount'=>"required",

    ]);

if($request->amount>session()->get('pending')){
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Insufficient Amount',

     );
     return redirect()->back()->with($notification);
}
    try {
        $vat=__getVatamount($request->amount);
        $tds=__gettdsAmount($request->amount);
        $charge=__getadminAmount($request->amount);
       $amount=$request->amount-$tds-$charge;
        $admin=new Withdrawal;
        $admin->amount=$request->amount;
        $admin->paying_amount=$amount;

        $admin->user_remark=$request->remark;

        $admin->user_id=Auth::user()->id;


        if($admin->save()){
            $notification=array(
                'alert-type'=>'success',
                'messege'=>'Withdrawal Request  sent',

             );
             return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'alert-type'=>'info',
                'messege'=>'Withdrawal Request notsent',

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

}
