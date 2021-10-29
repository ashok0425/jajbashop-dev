<?php

namespace App\Http\Controllers\Vendorpanel;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use File;
use Illuminate\Support\Facades\Auth;
use App\Models\ShopGallery;
use App\Models\Vendordetail;

class DetailController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file

function index(){
    $detail=Vendordetail::where('vendor_id',Auth::user()->id)->first();
    return view('vendorpanel.detail.create',compact('detail'));
}

    use status;

    public function store(Request $request)
    {
      
        try {
    $category=Vendordetail::where('vendor_id',Auth::user()->id)->first();
            if($category){
                $category->about=$request->about;
                 $file=$request->file('file');
                if($file){
                    File::delete($category->image);
                    $fname=rand().'thumbnail.'.$file->getClientOriginalExtension();
                    $category->image='upload/vendor/detail/'.$fname;
                    $file->move(public_path().'/upload/vendor/detail/',$fname);
                }
    
                $file=$request->file('cover');
               
                if($file){
                    File::delete($category->cover_image);
                    $fname=rand().'shopcover.'.$file->getClientOriginalExtension();
                    $category->cover_image='upload/vendor/shop/cover/'.$fname;
                    $file->move(public_path().'/upload/vendor/shop/cover/',$fname);
                }
                 $category->save();


            }else{
        
            $category=new Vendordetail;  
            $file=$request->file('file');
           
            if($file){
                $fname=rand().'thumbnail.'.$file->getClientOriginalExtension();
                $category->image='upload/vendor/detail/'.$fname;
                $file->move(public_path().'/upload/vendor/detail/',$fname);
            }

            $file=$request->file('cover');
           
            if($file){
                $fname=rand().'shopcover.'.$file->getClientOriginalExtension();
                $category->cover_image='upload/vendor/shop/cover/'.$fname;
                $file->move(public_path().'/upload/vendor/shop/cover/',$fname);
            }
            $category->vendor_id=Auth::user()->id;
            $category->about=$request->about;
            if($category->save()){
        
                $notification=array(
                    'alert-type'=>'success',
                    'messege'=>'Vendor info  Added',
                   
                 );
                 return redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'alert-type'=>'info',
                    'messege'=>'Vendor info added',
                   
                 );
                 return redirect()->back()->with($notification);
            }


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
