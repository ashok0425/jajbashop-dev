<?php

namespace App\Http\Controllers\Vendorpanel;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Ticket;

use Illuminate\Http\Request;
use App\Http\Traits\status;
use Illuminate\Support\Facades\Auth;
use File;
class PaymentController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment=Payment::where('vendor_id',Auth::user()->id)->orderBy('id','desc')->get();
       return view('vendorpanel.payment.index',compact('payment'));
    }



    public function ticket()
    {
        $ticket=Ticket::where('vendor_id',Auth::user()->id)->orderBy('id','desc')->get();
       return view('vendorpanel.payment.ticket',compact('ticket'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('vendorpanel.payment.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required',
   
        ]);
        try {
 
            $category=new Ticket;
       
            $category->vendor_id=Auth::user()->id;
            $category->title=$request->title;
            $category->date=date('Y-m-d');
            $category->descr=$request->description;

            if($category->save()){
                $notification=array(
                    'alert-type'=>'success',
                    'messege'=>'Ticket  Sucessfully Sent',
                   
                 );
                 return redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'alert-type'=>'info',
                    'messege'=>'Ticket  not sent',
                   
                 );
                 return redirect()->back()->with($notification);
            }
            
           
        } catch (\Throwable $th) {
            $notification=array(
                'alert-type'=>'error',
                'messege'=>'Something went wrong. Please try again later.',
                
             );
             return redirect()->back()->with($notification);
        
        }
    
    }
  
}
