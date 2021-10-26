<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposite;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class DepositeController extends Controller
{


    public  function pending(){
        $deposite=DB::table('deposites')->join('users','users.id','deposites.user_id')->where('deposites.status',0)->select('users.name','users.userid','deposites.*')->get();
        return view('admin.deposite.pending',compact('deposite'));
    }

    public  function rejected(){
        $deposite=DB::table('deposites')->join('users','users.id','deposites.user_id')->where('deposites.status',1)->select('users.name','users.userid','deposites.*')->get();
        return view('admin.deposite.rejected',compact('deposite'));
    }

    public  function accepted(){
        $deposite=DB::table('deposites')->join('users','users.id','deposites.user_id')->where('deposites.status',2)->select('users.name','users.userid','deposites.*')->get();
        return view('admin.deposite.approved',compact('deposite'));
    }




    public function update(Request $request){//update profile of memeber
        $request->validate([
            'id'=>'required',

        ]);
        try {

            $admin=Deposite::find($request->id);
            $admin->status=$request->status;
            $admin->admin_remark=$request->remark;



            if($admin->save()){
                $notification=array(
                    'alert-type'=>'success',
                    'messege'=>'Deposite Request  updated',

                 );
                 return redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'alert-type'=>'info',
                    'messege'=>'Deposite Request not updated',

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
