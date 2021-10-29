<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Product;
use App\Models\Ecommerce\Sellerreview;
use App\Models\Ecommerce\Productvariation;
use Illuminate\Support\Facades\DB;
use App\Models\Ecommerce\Productcolor;
use Illuminate\Support\Facades\Auth;
use App\Models\Ecommerce\Productreview;
use Illuminate\Support\Facades\Mail;
use App\Models\Ecommerce\Category;
use App\Models\Ecommerce\Brand;
use App\Models\Ecommerce\Question;
use App\Models\Ecommerce\Subcategory;
use App\Models\Ecommerce\User;
use Illuminate\Support\Arr;
use Session;
class ProductController extends Controller
{
    public function search($name,$category=null){


        $products=Product::where('name','LIKE','%'.$name. '%')->limit(7)->where('status',1)->get();

        $data="";
        if(count($products)>0){

        foreach($products as $cat){
          $data.=" <div class='card-header py-2 border-bottom'>
        <a href='";
        //  $data.=route('product.detail',['id'=>$cat->id,'product_name'=>$cat->product_name]);
         $data.="' style='color:black;width:100%;display:block;' class='filters'>";
          $data.= $cat->name;
          $data.="</a>
          </div>";

    }


}else{
  $data.=" <div class='card-header py-2 border-bottom'>
<a href='";
//  $data.=route('product.detail',['id'=>$cat->id,'product_name'=>$cat->product_name]);
 $data.="' style='color:red;width:100%;'>";
  $data.= 'No product found';
  $data.="</a>
  </div>";
}
return response()->json($data);
}






// product detail page
public function productDetail($id,$name){


// try {
    $product=DB::connection('mysql2')->table('products')->join('users','users.id','products.vendor_id')->join('categories','products.category_id','categories.id')->select('products.*','categories.category','users.id as uid','users.display_name')->where('products.id',$id)->where('products.status',1)->first();
    $variation=Productvariation::where('product_id',$id)->get();
    $first=Productvariation::where('product_id',$id)->first();

    $rating=Productreview::where('product_id',$id)->avg('rating');
    $color=Productcolor::where('product_id',$id)->get();
    if($product){
        return view('frontend.productdetail',compact('product','variation','color','rating','first'));

    }

// } catch (\Throwable $th) {
//     $notification=array(
//         'alert-type'=>'error',
//         'messege'=>'Something went wrong.Please try again later',

//      );
//      return redirect()->back()->with($notification);
// }
}



// product quick view

public function quickview($id,$value){


    try {
        $product=DB::connection('mysql2')->table('products')->join('brands','products.brand_id','brands.id')->join('categories','products.category_id','categories.id')->select('products.*','brands.brand','categories.category')->where('products.id',$id)->where('products.status',1)->first();
        $size=Productvariation::where('product_id',$id)->get();
        $first=Productvariation::where('product_id',$id)->first();
        $color=Productcolor::where('product_id',$id)->get();
     

  return view('frontend.ajaxload.quickview',compact('product','size','color','first','value'));
    } catch (\Throwable $th) {
        $notification=array(
            'alert-type'=>'error',
            'messege'=>'Something went wrong.Please try again later',

         );
         return redirect()->back()->with($notification);
    }
    }


public function loadPrice($id){
    $price=Productvariation::find($id);
   if($price->offer_price!=null){
       $total=$price->offer_price;
   }else{
    $total=$price->price;
   }
   $data=[
       'price'=>$total,
       'qty'=>$price->qty,
   ];
    return response()->json($data);
}


public function loadImage($id){
 $image=Productcolor::find($id);
 return response()->json(asset($image->image));
}



public function productSearch(Request $request){

    dd($request->all());
    $product=DB::connection('mysql2')->table('products')->where('name','LIKE','%'.$request->search. '%')->where('status',1)->paginate(24);
    $load=  1;
    $subcategory=Subcategory::where('status',1)->get();
    $category=Category::where('status',1)->get();
    $brand=Brand::groupBy('brand')->select('brand')->where('status',1)->get();
    return view('frontend.store',compact('product','load','subcategory','category','brand'));
}

public function allProduct($id){
    $load=  1;
    if($id='featured'){
        $product=DB::connection('mysql2')->table('products')->where('featured',1)->where('status',1)->paginate(24);

    }
    elseif($id='bestseller'){
        $product=DB::connection('mysql2')->table('products')->where('bestseller',1)->where('status',1)->paginate(24);

    }
    elseif($id='deal'){
        $product=DB::connection('mysql2')->table('products')->where('offer',1)->where('status',1)->paginate(24);

    }
    elseif($id='newarrival'){
        $product=DB::connection('mysql2')->table('products')->where('status',1)->paginate(24);

    }
    elseif($id='top_rated'){
        $product=DB::connection('mysql2')->table('products')->where('top_rated',1)->paginate(24);

    }else{
        $product=DB::connection('mysql2')->table('products')->where('status',1)->paginate(24);

    }
    $subcategory=Subcategory::where('status',1)->get();
    $category=Category::all();
    $brand=Brand::where('status',1)->get();
    return view('frontend.store',compact('product','load','subcategory','category','brand'));
}


public function categoryproduct($id,$category){
    $load=  1;
    $product=DB::connection('mysql2')->table('products')->where('category_id',$id)->where('status',1)->paginate(24);
    $subcategory=Subcategory::all();
    $category=Category::all();
    $brand=Brand::groupBy('brand')->select('brand')->where('status',1)->get();
    return view('frontend.store',compact('product','load','subcategory','category','brand','id'));
}

public function subcategoryproduct($id,$category){
    $load=  2;
    $product=DB::connection('mysql2')->table('products')->where('subcategory_id',$id)->where('status',1)->paginate(24);
    $subcategory=Subcategory::where('status',1)->get();
    $category=Category::where('status',1)->get();
    $brand=Brand::groupBy('brand')->select('brand')->where('status',1)->get();
    return view('frontend.store',compact('product','load','subcategory','category','brand','id'));

}


public function brandproduct($id,$category){
    $load=  3;
    $product=DB::connection('mysql2')->table('products')->where('brand_id',$id)->where('status',1)->paginate(24);
    $subcategory=Subcategory::all();
    $category=Category::all();
    $brand=Brand::groupBy('brand')->select('brand')->where('status',1)->get();
    return view('frontend.store',compact('product','load','subcategory','category','brand','id'));

}



public function filterProductAjax(Request $request){

    if(isset($request->rating)){
        $category_all="SELECT products.*,avegrageproductratings.rating FROM products  JOIN avegrageproductratings ON products.id=avegrageproductratings.product_id WHERE products.status=1 ";

    }
    else{
        $category_all="SELECT products.* FROM products   WHERE status=1 ";

    }

 if(isset($request->min) || isset($request->max)  && !empty($request->min) && !empty( $request->max)){
   $category_all .= " AND price BETWEEN $request->min AND $request->max";
 }


 if(isset($request->category )){
     $ex=implode("','",$request->category);
  $category_all .= " AND  category_id IN ('".$ex."')";

 }
 if(isset($request->brand )){

     $brand=DB::connection('mysql2')->table('brands')->whereIn('brand',$request->brand)->get();
     $brandId=array();
     foreach($brand as $value){
         $brandId[]=$value->id;
     }
    $ex=implode("','",$brandId);

 $category_all .= " AND  brand_id IN ('".$ex."')";

}
if(isset($request->subcategory )){
    $ex=implode("','",$request->subcategory);
 $category_all .= " AND  subcategory_id IN ('".$ex."')";

}

if(isset($request->rating )){
   
  $ex=implode("','",$request->rating);
 $category_all .= " AND  rating IN ('".$ex."')";
  
    
  if(isset($request->order)&&$request->order==2){
  
    $category_all .= "   ORDER BY products.id DESC ";

   }
  if(isset($request->order)&&$request->order==2){
  
       $category_all .= "   ORDER BY products.id ASC ";
  
      }
      if(isset($request->order)&&$request->order==3){
  
           $category_all .= "  ORDER  BY  products.name  ASC ";
  
          }
          if(isset($request->order)&&$request->order==4){
  
               $category_all .= "   ORDER BY products.name DESC ";
  
              }


}else{
    if(isset($request->order)&&$request->order==1){

        $category_all .= "   ORDER BY id DESC ";
      
      
       }
      if(isset($request->order)&&$request->order==2){
      
           $category_all .= "   ORDER BY id ASC ";
      
          }
          if(isset($request->order)&&$request->order==3){
      
               $category_all .= "  ORDER  BY  name  ASC ";
      
              }
              if(isset($request->order)&&$request->order==4){
      
                   $category_all .= "   ORDER BY name DESC ";
      
                  }
}

$product=DB::connection('mysql2')->select($category_all);
    
return view('frontend.ajaxload.storeproduct',compact('product'));


  }


public function report(Request $request){
if(Auth::check()){
   try {
     $report=array();
$report['product_id']=$request->id;
$report['vendor_id']=$request->vid;
$report['user_id']=Auth::user()->id;
$report['reason']=$request->reason;
DB::connection('mysql2')->table('productreports')->insert($report);
$data=array(
    'report'=>$request->reason,
);
Mail::to(Auth::user()->email)->send(new reportproduct($data));
$email=DB::connection('mysql2')->table('users')->where('id',$request->vid)->value('email');

Mail::to($email)->send(new reportproduct($data));
    $notification=array(
        'messege'=>'Your report hasbeen approved.we will get back to you soon.',
        'alert-type'=>'success'
         );
       return Redirect()->back()->with($notification);
   } catch (\Throwable $th) {

    $notification=array(
        'messege'=>'Something went wrong.Please try again later.',
        'alert-type'=>'error'
         );
       return Redirect()->back()->with($notification);
   }


}else{
       return redirect()->route('login');
}
}


// product detail load using ajax 

public function loadproductDetail($load,$id){


    // try {
        $product=DB::connection('mysql2')->table('products')->where('id',$id)->first();
       
     if($load==1){
        return view('frontend.ajaxload.productdetail',compact('product'));

     }elseif($load==2){
        return view('frontend.ajaxload.productterm',compact('product'));

     
    }elseif($load==3){
      
        $rating=Productreview::where('product_id',$id)->join('users','users.id','productreviews.user_id')->select('productreviews.*','users.name','users.profile_photo_path','users.id as uid')->orderBy('productreviews.id','desc')->get();
        $avg=Productreview::where('product_id',$id)->avg('rating');
        $avg1=Productreview::where('product_id',$id)->where('rating',1)->avg('rating');
        $avg2=Productreview::where('product_id',$id)->where('rating',2)->avg('rating');
        $avg3=Productreview::where('product_id',$id)->where('rating',3)->avg('rating');
        $avg4=Productreview::where('product_id',$id)->where('rating',4)->avg('rating');
        $avg5=Productreview::where('product_id',$id)->where('rating',5)->avg('rating');
        $seller=User::find(Product::find($id)->value('id'));
        return view('frontend.ajaxload.productreview',compact('rating','id','avg','avg1','avg2','avg3','avg4','avg5','seller'));


    }elseif($load==4){
        $rating=Sellerreview::where('seller_id',$id)->join('users','users.id','sellerreviews.user_id')->select('sellerreviews.*','users.name','users.profile_photo_path','users.id as uid')->orderBy('sellerreviews.id','desc')->get();
        $avg=Sellerreview::where('seller_id',$id)->avg('rating');
        $avg1=Sellerreview::where('seller_id',$id)->where('rating',1)->avg('rating');
        $avg2=Sellerreview::where('seller_id',$id)->where('rating',2)->avg('rating');
        $avg3=Sellerreview::where('seller_id',$id)->where('rating',3)->avg('rating');
        $avg4=Sellerreview::where('seller_id',$id)->where('rating',4)->avg('rating');
        $avg5=Sellerreview::where('seller_id',$id)->where('rating',5)->avg('rating');
        $seller=User::find(Product::find($id)->value('id'));
        return view('frontend.ajaxload.sellerinfo',compact('rating','id','avg','avg1','avg2','avg3','avg4','avg5','seller'));

     }
     elseif($load==5){
        $question=Question::where('product_id',$id)->join('users','users.id','questions.user_id')->select('questions.*','users.name','users.profile_photo_path','users.id as uid')->orderBy('questions.id','desc')->get();
        $seller=User::find(Product::find($id)->value('id'));

        return view('frontend.ajaxload.q&a',compact('question','id','seller'));

     }

    // } catch (\Throwable $th) {
    //     $notification=array(
    //         'alert-type'=>'error',
    //         'messege'=>'Something went wrong.Please try again later',

    //      );
    //      return redirect()->back()->with($notification);
    // }
    }
}

