<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposite;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class DepositeController extends Controller
{


    public  function pending(){
        $deposite=DB::table('deposites')->join('users','users.id','deposites.user_id')->where('user_id',Auth::user()->id)->where('deposites.status',0)->select('users.name','users.userid','deposites.*')->get();
        return view('member.deposite.pending',compact('deposite'));
    }

    public  function rejected(){
        $deposite=DB::table('deposites')->join('users','users.id','deposites.user_id')->where('user_id',Auth::user()->id)->where('deposites.status',1)->select('users.name','users.userid','deposites.*')->get();
        return view('member.deposite.rejected',compact('deposite'));
    }

    public  function accepted(){
        $deposite=DB::table('deposites')->join('users','users.id','deposites.user_id')->where('user_id',Auth::user()->id)->where('deposites.status',2)->select('users.name','users.userid','deposites.*')->get();
        return view('member.deposite.approved',compact('deposite'));
    }




public  function create(){
    return view('member.deposite.request');
}



public function store(Request $request){//update profile of memeber
    $request->validate([
        'remark'=>'required',
        'amount'=>"required",
        'file'=>"required",

    ]);
    try {

        $admin=new Deposite;


        $file=$request->file('file');

        if($file){
            $fname=rand().'deposite.'.$file->getClientOriginalExtension();
            $admin->image='upload/deposite/'.$fname;
            $path=$file->move(public_path().'/upload/deposite/',$fname);

        }
        $admin->amount=$request->amount;
        $admin->user_remark=$request->remark;
        $admin->user_id=Auth::user()->id;


        if($admin->save()){
            $notification=array(
                'alert-type'=>'success',
                'messege'=>'Deposited Request  sent',

             );
             return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'alert-type'=>'info',
                'messege'=>'Deposited Request notsent',

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
