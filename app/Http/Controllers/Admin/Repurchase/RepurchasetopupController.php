<?php

namespace App\Http\Controllers\Admin\Repurchase;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Level;
use App\Models\Levelprice;
use App\Models\RepurchaseTopup;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RepurchasetopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level=RepurchaseTopup::all();
        return view('admin.repurchase.repurchasetopup.index',compact('level'));
    }


    public function edit($id)
    {
        $level=RepurchaseTopup::find($id);
        return view('admin.repurchase.repurchasetopup.edit',compact('level'));
    }

  
    public function update(Request $request)
    {
        $level=RepurchaseTopup::find($request->id);
        $level->percent=$request->percent;
        $level->save();
        $notification=array(
            'messege'=>'ReurchaseTopup updated Sucessfully',
             'alert-type'=>'success'
         );

        return redirect()->route('admin.repurchasetopup.price')->with($notification);
    }


}
