<?php

namespace App\Http\Controllers\Admin\repurchase;
use App\Http\Controllers\Controller;
use App\Models\Repurchasecommision;
use Illuminate\Http\Request;

class repurchaseController extends Controller
{

    public function index()
    {
        $repurchase=Repurchasecommision::all();
        return view('admin.repurchase.repurchase.index',compact('repurchase'));
    }


 
    public function edit($id)
    {
        $level=Repurchasecommision::find($id);
        return view('admin.repurchase.repurchase.edit',compact('level'));
    }

    public function update(Request $request)
    {
        $level=Repurchasecommision::find($request->id);
        $level->min_bv=$request->min_bv;
        $level->max_bv=$request->max_bv;
        $level->percent=$request->percent;

        $level->save();
        $notification=array(
            'messege'=>'Repurchasecommision updated Sucessfully',
             'alert-type'=>'success'
         );

        return redirect()->route('admin.repurchase.comission')->with($notification);
    }

 
}
