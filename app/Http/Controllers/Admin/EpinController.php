<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use App\Models\Epin;
use App\Models\Epintransfer;

use Illuminate\Support\Facades\DB;

class EpinController extends Controller
{

//transfer view page
public  function used(){

    $pin=DB::table('epintransfers')->join('users','users.userid','epintransfers.receiver')->join('epins','epins.id','epintransfers.epin_id')->select('epins.epin','users.name','epintransfers.receiver','epins.package','epins.created_at','epins.status','epins.usedBy','epins.used_at')->orderBy('epins.id','desc')->where('epins.status','used')->get();
    return view('admin.epin.used',compact('pin'));
}

public  function unused(){
    $pin=DB::table('epintransfers')->join('users','users.userid','epintransfers.receiver')->join('epins','epins.id','epintransfers.epin_id')->select('epins.epin','epins.package','users.name','epintransfers.receiver','epins.created_at','epins.status')->orderBy('epins.id','desc')->where('epins.status','unused')->get();
    return view('admin.epin.unused',compact('pin'));
}


//transfer view page
    public  function transfer($userid=null){
        $userid=$userid;
    
        return view('admin.epin.transfer',compact('userid'));
    }

//transfer view page
public  function history(){

$pin=DB::table('epintransfers')->leftjoin('users','users.userid','epintransfers.receiver')->join('epins','epins.id','epintransfers.epin_id')->select('epins.epin','epins.package','users.name','epintransfers.receiver','epins.created_at','epins.status')->orderBy('epins.id','desc')->get();

    return view('admin.epin.history',compact('pin'));
}


// storing epin
    public  function store(Request $request){

        $request->validate([
            'user_id'=>'required',
            'number'=>'required',

        ]);
        for ($i=0; $i <$request->number ; $i++) {
            # code...
            $epin=new Epin;
            $epin->epin=uniqid().rand(1,9999999).$request->package;
            $epin->package=$request->package;
           if( $epin->save()){
               $transfer=new Epintransfer;
                $transfer->receiver=$request->user_id;
                $transfer->transfer='Admin';
                $transfer->epin_id=$epin->id;


                $transfer->save();
           }

        }

        $notification=array(
            'messege'=>'E-pin Transfer Sucessfully',
             'alert-type'=>'success'
         );

       return redirect()->back()->with($notification);
    }


    //message request for Epin from user
    public function request()
    {
        $ticket=DB::table('users')->rightjoin('tickets','tickets.user_id','users.userid')->where('tickets.status',1)->orderBy('tickets.id','desc')->get();
        return view('admin.epin.request',compact('ticket'));
    }


// load availabe epin for admin using ajax
public function loadepin(){


    $pin=DB::table('epintransfers')->join('epins','epins.id','epintransfers.epin_id')->select('epins.epin','epins.package')->where('epins.status','Unused')->where('epintransfers.receiver','Admin')->orderBy('epins.id','desc')->get();
    $data="
    <div class='text-center mt-2 border-bottom border-1'>Available E-pin</div>

    <ul class='mt-3'>";
    foreach ($pin as $value) {
        $data.="<li class='pincode my-1'><span class='pincodeinner'>$value->epin</span> | ";
        if($value->package==1){
            $data.="package-1000";
        }else{
            $data.="package-650";
        }

        $data.="</li>";

    }
    $data.="</ul>";
    return response()->json($data);
}

}
