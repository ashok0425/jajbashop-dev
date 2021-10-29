<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Blog;
use App\Models\Ecommerce\faq;

use Illuminate\Http\Request;
use App\Models\Ecommerce\Blogcategory;
use App\Models\Ecommerce\Product;
use App\Models\Ecommerce\Productcolor;
use App\Models\Ecommerce\Wishlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
class BlogController  extends Controller
{

    public function index(){

        return view('frontend.blog');
      }

      public function single($id){
        $blog =Blog::find($id) ;
      return view('frontend.singleblog',compact('blog'));
    }

    public function faq(){
      $blog =faq::orderBy('id','desc')->get() ;
    return view('frontend.faq',compact('blog'));
  }
}

