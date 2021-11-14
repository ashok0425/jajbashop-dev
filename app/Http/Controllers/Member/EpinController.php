<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use App\Models\Epin;
use App\Models\Epintransfer;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class EpinController extends Controller
{

//transfer view page
public  function used(){

    $pin=DB::table('epintransfers')->join('users','users.userid','epintransfers.receiver')->join('epins','epins.id','epintransfers.epin_id')->select('epins.epin','users.name','epintransfers.receiver','epins.created_at','epins.status','epins.package','epins.usedBy','epins.used_at')->orderBy('epins.id','desc')->where('epins.status','used')->where('epintransfers.receiver',Auth::user()->userid)->get();
    return view('member.epin.used',compact('pin'));
}

public  function unused(){
    $pin=DB::table('epintransfers')->join('epins','epins.id','epintransfers.epin_id')->select('epins.*','epintransfers.transfer')->where('epintransfers.receiver',Auth::user()->userid)->where('epins.status','Unused')->orderBy('epintransfers.id','desc')->get();
    return view('member.epin.unused',compact('pin'));
}


//transfer view page
    public  function transfer($userid=null){
        $pin=DB::table('epintransfers')->join('epins','epins.id','epintransfers.epin_id')->select('epins.*','epintransfers.transfer')->where('epintransfers.receiver',Auth::user()->userid)->where('epins.status','Unused')->orderBy('epintransfers.id','desc')->get();

        return view('member.epin.transfer',compact('pin'));
    }


    //recive history view page
    public  function recivehistory($userid=null){
        $pin=DB::table('epintransfers')->join('epins','epins.id','epintransfers.epin_id')->select('epins.epin','epintransfers.transfer','epins.created_at','epins.status','epins.package')->where('epintransfers.receiver',Auth::user()->userid)->orderBy('epintransfers.id','desc')->get();
        return view('member.epin.recivehistory',compact('pin'));
    }

 //transfer history view page
 public  function transferhistory($userid=null){
    $pin=DB::table('epintransfers')->join('epins','epins.id','epintransfers.epin_id')->select('epins.epin','epintransfers.receiver','epins.created_at','epins.status','epins.package')->where('epintransfers.transfer',Auth::user()->userid)->orderBy('epintransfers.id','desc')->get();


        return view('member.epin.transferhistory',compact('pin'));
    }

// storing epin
    public  function store(Request $request){

        $request->validate([
            'title'=>'required',
            'number'=>'required',

        ]);
            $ticket=new Ticket;
            $ticket->user_id=Auth::user()->userid;
            $ticket->title=$request->title;
            $ticket->qty=$request->number;
            $ticket->status=1;

            if($ticket->save()){
                $notification=array(
                    'messege'=>'Ticket Created and sent Sucessfully',
                     'alert-type'=>'success'
                 );

               return redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'messege'=>'Ticket Not Created',
                     'alert-type'=>'error'
                 );

               return redirect()->back()->with($notification);
            }



    }


    public function request()
    {
        $ticket=DB::table('users')->rightjoin('tickets','tickets.user_id','users.userid')->where('users.status',1)->orderBy('tickets.id','desc')->get();
        return view('member.epin.request',compact('ticket'));
    }





    // Transfering epin
    public  function transerferpin(Request $request){
        $request->validate([
            'user_id'=>'required',
            'epin'=>'required',

        ]);

       foreach ($request->epin as  $value) {
           $pin=new Epintransfer;
           $pin->receiver=$request->user_id;
           $pin->transfer=Auth::user()->userid;
           $pin->epin_id=$value;
           $pin->save();

       }

        $notification=array(
            'messege'=>'E-pin Transfer Sucessfully',
             'alert-type'=>'success'
         );

       return redirect()->back()->with($notification);
    }


    // load availabe epin for admin using ajax
public function loadepin(){



    $pin=DB::table('epintransfers')->join('epins','epins.id','epintransfers.epin_id')->select('epins.*','epintransfers.transfer')->where('epins.status','Unused')->orderBy('epintransfers.id','desc')->get();

    $data="
    <div class='text-center mt-2 border-bottom border-1'>Available E-pin</div>

    <ul class='mt-3'>";
    foreach ($pin as $value) {
        $last=Epintransfer::where('epin_id',$value->id)->latest()->first();

        if(strtolower($last->receiver)==strtolower(Auth::user()->userid)){

        $data.="<li class='pincode my-1'><span class='pincodeinner'>$value->epin</span> | ";
        if($value->package==1){
            $data.="package-1000";
        }else{
            $data.="package-650";
        }

        $data.="</li>";
    }

    }
    $data.="</ul>";
    return response()->json($data);
}

}
