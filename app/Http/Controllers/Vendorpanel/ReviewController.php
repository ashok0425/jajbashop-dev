<?php

namespace App\Http\Controllers\Vendorpanel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Auth;
use carbon;
class ReviewController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newproductreview()
    {
        $review=DB::table('productreviews')->join('products','products.id','productreviews.product_id')->select('productreviews.*','products.name','products.id as pid','products.slug')->where('products.vendor_id',Auth::user()->id)->orderBy('id','desc')->where('productreviews.created_at',today())->get();
       return view('vendorpanel.review.newproduct',compact('review'));
    }

    public function allproductreview()
    {
        $review=DB::table('productreviews')->join('products','products.id','productreviews.product_id')->select('productreviews.*','products.name','products.id as pid','products.slug')->where('products.vendor_id',Auth::user()->id)->orderBy('id','desc')->get();
       return view('vendorpanel.review.allproduct',compact('review'));
    }



    public function newsellerreview()
    {
        $review=DB::table('sellerreviews')->where('seller_id',Auth::user()->id)->where('created_at',today())->orderBy('id','desc')->get();
       return view('vendorpanel.review.newseller',compact('review'));
    }

    public function allsellerreview()
    {
        $review=DB::table('sellerreviews')->where('seller_id',Auth::user()->id)->orderBy('id','desc')->get();
       return view('vendorpanel.review.allseller',compact('review'));
    }


    public function newqa()
    {
        $review=DB::table('questions')->join('products','products.id','questions.product_id')->select('questions.*','products.name','products.id as pid','products.slug')->where('products.vendor_id',Auth::user()->id)->orderBy('id','desc')->where('questions.created_at',today())->get();
       return view('vendorpanel.review.newqa',compact('review'));
    }



    public function allqa()
    {
        $review=DB::table('questions')->join('products','products.id','questions.product_id')->select('questions.*','products.name','products.id as pid','products.slug')->where('products.vendor_id',Auth::user()->id)->orderBy('id','desc')->get();
       return view('vendorpanel.review.allqa',compact('review'));
    }
}
