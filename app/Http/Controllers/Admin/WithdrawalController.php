<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Withdrawal;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class WithdrawalController extends Controller
{


    public  function pending(){
        $withdrawal=DB::table('withdrawals')->join('users','users.id','withdrawals.user_id')->join('kycs','kycs.user_id','users.id')->where('withdrawals.status',0)->select('users.name','users.userid','withdrawals.*','kycs.ifsc','kycs.account_no')->get();
        return view('admin.withdrawal.pending',compact('withdrawal'));
    }

    public  function rejected(){
        $withdrawal=DB::table('withdrawals')->join('users','users.id','withdrawals.user_id')->where('withdrawals.status',1)->select('users.name','users.userid','withdrawals.*')->get();
        return view('admin.withdrawal.rejected',compact('withdrawal'));
    }

    public  function approved(){
        $withdrawal=DB::table('withdrawals')->join('users','users.id','withdrawals.user_id')->where('withdrawals.status',2)->select('users.name','users.userid','withdrawals.*')->get();
        return view('admin.withdrawal.approved',compact('withdrawal'));
    }




public  function create(){
    return view('admin.withdrawal.request');
}



public function update(Request $request){//update profile of memeber
    $request->validate([
        'id'=>'required',

    ]);
    try {

        $admin=Withdrawal::find($request->id);
        $admin->status=$request->status;
        $admin->admin_remark=$request->remark;



        if($admin->save()){
            $notification=array(
                'alert-type'=>'success',
                'messege'=>'Withdrawal Request  updated',

             );
             return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'alert-type'=>'info',
                'messege'=>'Withdrawal Request not updated',

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
