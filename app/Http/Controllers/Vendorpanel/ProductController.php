<?php

namespace App\Http\Controllers\Vendorpanel;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use App\Models\Subcategory;
use App\Models\Website;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Gst;
use App\Models\Productcolor;
use App\Models\Productvariation;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use File;
use Image;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
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
        $product=DB::table('products')->join('categories','categories.id','products.category_id')->select('products.*','categories.category')->orderBy('products.id','desc')->where('vendor_id',Auth::user()->id)->get();
       return view('vendorpanel.product.index',compact('product'));
    }


    public function create()
    {
        $category=Category::all();
       return view('vendorpanel.product.create',compact('category'));

    }




    public function store(Request $request)
    {

        if(isset($request->video)){
            $request->validate([
                'category'=>'required',
                'name'=>'required',
                'price'=>'required',
                'product_id'=>'required',
                'file'=>'required|mimes:png,jpg,gif',
                'short_description'=>'required|max:255',
                'long_description'=>'required',
                'video'=>'required|max:10000'

            ]);
        }else{
            $request->validate([
                'category'=>'required',
                'name'=>'required',
                'price'=>'required',
                'product_id'=>'required',
                'file'=>'required|mimes:png,jpg,gif',
                'short_description'=>'required|max:255',
                'long_description'=>'required',

            ]);
        }

        // try {
            $product=new Product;
            $hsn=Gst::where('hsn',$request->hsn)->value('id');
            
            $file=$request->file('file');
            if($file){
                $fname=rand().'product.'.$file->getClientOriginalExtension();

                    // for small image
                $path='upload/product/'.$fname;
                $product->image=$path;
                Image::make($file)->resize(290, 290)->save($path);

                // for large image 
                $lpath='upload/product/large/'.$fname;
                Image::make($file)->resize(800, 900)->save($lpath);
                $product->large_image=$lpath;
               
            }

            $front=$request->file('front');
            if($front){
                // for small view 
                $fname=rand().'productf.'.$front->getClientOriginalExtension();
                $path='upload/product/'.$fname;
                $product->front=$path;
                Image::make($front)->resize(290, 290)->save($path);

                // for large view 
                $lpath='upload/product/large/'.$fname;
                Image::make($front)->resize(800, 900)->save($lpath);
                $product->large_front=$lpath;
                $front->move(public_path().'/upload/product/',$fname);
            }

            $back=$request->file('back');
            if($back){
                $fname=rand().'productb.'.$back->getClientOriginalExtension();
                // for small image 
                $path='upload/product/'.$fname;
                $product->back=$path;
                Image::make($back)->resize(290, 290)->save($path);

                // for large image 
                $lpath='upload/product/large/'.$fname;
                Image::make($back)->resize(800, 900)->save($lpath);
                $product->large_back=$lpath;
                $back->move(public_path().'/upload/product/',$fname);
            }

            $left=$request->file('left');
            if($left){
                $fname=rand().'productl.'.$left->getClientOriginalExtension();
                // for small image 
                $path='upload/product/'.$fname;
                $product->left=$path;
                Image::make($left)->resize(290, 290)->save($path);

                // for large image 
                $lpath='upload/product/large/'.$fname;
                Image::make($left)->resize(800, 900)->save($lpath);
                $product->large_left=$lpath;
            }

            $right=$request->file('right');
            if($right){
                $fname=rand().'productr.'.$right->getClientOriginalExtension();
                // for small image 
                $path='upload/product/'.$fname;
                $product->right=$path;
                Image::make($right)->resize(290, 290)->save($path);

                // for large image 
                $lpath='upload/product/large/'.$fname;
                Image::make($right)->resize(800, 900)->save($lpath);
                $product->large_right=$lpath;
            }



            $video=$request->file('video');
            if($video){

                $fname=rand().'video.'.$video->getClientOriginalExtension();
                $product->video='upload/product/video/'.$fname;
                // $path=Image::make($file)->resize(200,300);
                $video->move(public_path().'/upload/product/video/',$fname);
            }
            $product->category_id=$request->category;
            $product->subcategory_id=$request->subcategory;
            $product->brand_id=$request->brand;
            $product->sku=$request->sku;
            $product->product_id=$request->product_id;
            $product->price=$request->price;
            $product->offer_price=$request->offer_price;
            $product->name=$request->name;
            $product->delivery_time=$request->delivery_time;
            $product->delivery_charge=$request->delivery_charge;
            $product->featured=$request->featured;
            $product->top_rated=$request->top_rated;
            $product->bestseller=$request->bestseller;
            $product->short_desc=$request->short_description;
            $product->detail=$request->long_description;
            $product->qty=$request->quantity;
            $product->meta_title=$request->meta_title;
            $product->meta_descr=$request->meta_description;
            $product->meta_keyword=$request->meta_keyword;
            $product->term=$request->term;
            $product->Isrefundable=$request->isrefundable;
            $product->slug=$request->slug;
            $product->weight=$request->weight;
            $product->height=$request->height;
            $product->width=$request->width;
            $product->length=$request->length;
            $product->vendor_id=Auth::user()->id;
            $product->hsn_id=$hsn;
            if($product->save()){
                // storing color and image
                if(isset($request->color)&&count($request->color)>1){
              $clength=count($request->color);
              for ($i=0; $i<$clength; $i++) {
                  $color=new Productcolor;
                  $color->color=$request->color[$i];
                  $color->product_id=$product->id;
                  $image=$request->file('color_image')[$i];

                  if($image){

                    $fname=rand().'color.'.$image->getClientOriginalExtension();
                    $color->image='upload/product/color/'.$fname;
                    $lpath='upload/product/color/'.$fname;
                Image::make($image)->resize(800, 900)->save($lpath);
                $color->large_image=$lpath;
                    $image->move(public_path().'/upload/product/color/',$fname);
                }
                $color->save();
              }
            }

                  // storing variation
                if(isset($request->size) && count($request->size)>1){

                  $slength=count($request->size);
                  for ($i=0; $i <$slength; $i++) {
                      $size=new Productvariation;
                      $size->size=$request->size["$i"];
                     $size->product_id=$product->id;
                      $size->price=$request->size_price["$i"];
                      $size->offer_price=$request->size_offer_price["$i"];
                      $size->qty=$request->size_qty["$i"];
                      $size->save();
                  }}


                $notification=array(
                    'alert-type'=>'success',
                    'messege'=>'Product  Added',

                 );
                 return redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'alert-type'=>'info',
                    'messege'=>'Product  not added',

                 );
                 return redirect()->back()->with($notification);
            }


        // } catch (\Throwable $th) {
        //     $notification=array(
        //         'alert-type'=>'error',
        //         'messege'=>'Something went wrong. Please try again later.',

        //      );
        //      return redirect()->back()->with($notification);

        // }

    }


    public function edit(Product $product,$id)
    {
        $product=Product::where('vendor_id',Auth::user()->id)->where('id',$id)->first();
        $category=Category::all();
        $subcategory=Subcategory::find($product->subcategory_id);
        $brand=Brand::find($product->brand_id);
        $color=Productcolor::where('product_id',$id)->get();
        $size=Productvariation::where('product_id',$id)->get();
        $phsn=Gst::where('id',$product->hsn_id)->value('hsn');

        return view('vendorpanel.product.edit',compact('product','subcategory','category','color','size','brand','phsn'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category'=>'required',
            'name'=>'required',
            'price'=>'required',
            'product_id'=>'required',
            'short_description'=>'required|max:255',
            'long_description'=>'required',

        ]);
        // try {
            $product=Product::find($request->id);
            $hsn=Gst::where('hsn',$request->hsn)->value('id');
            $file=$request->file('file');
            if($file){
                File::delete($product->image);
                File::delete($product->large_image);
                $fname=rand().'product.'.$file->getClientOriginalExtension();

                    // for small image
                $path='upload/product/'.$fname;
                $product->image=$path;
                Image::make($file)->resize(290, 290)->save($path);

                // for large image 
                $lpath='upload/product/large/'.$fname;
                Image::make($file)->resize(800, 900)->save($lpath);
                $product->large_image=$lpath;
               
            }
            $front=$request->file('front');

            if($front){
                File::delete($product->front);
                File::delete($product->large_front);
                // for small view 
                $fname=rand().'productf.'.$front->getClientOriginalExtension();
                $path='upload/product/'.$fname;
                $product->front=$path;
                Image::make($front)->resize(290, 290)->save($path);

                // for large view 
                $lpath='upload/product/large/'.$fname;
                Image::make($front)->resize(800, 900)->save($lpath);
                $product->large_front=$lpath;
                $front->move(public_path().'/upload/product/',$fname);
            }
            $back=$request->file('back');

            if($back){
                File::delete($product->back);
                File::delete($product->large_back);
                $fname=rand().'productb.'.$back->getClientOriginalExtension();
                // for small image 
                $path='upload/product/'.$fname;
                $product->back=$path;
                Image::make($back)->resize(290, 290)->save($path);

                // for large image 
                $lpath='upload/product/large/'.$fname;
                Image::make($back)->resize(800, 900)->save($lpath);
                $product->large_back=$lpath;
                $back->move(public_path().'/upload/product/',$fname);
            }
            $left=$request->file('left');

            if($left){
                File::delete($product->left);
                File::delete($product->large_left);
                $fname=rand().'productl.'.$left->getClientOriginalExtension();
                // for small image 
                $path='upload/product/'.$fname;
                $product->left=$path;
                Image::make($left)->resize(290, 290)->save($path);

                // for large image 
                $lpath='upload/product/large/'.$fname;
                Image::make($left)->resize(800, 900)->save($lpath);
                $product->large_left=$lpath;
            }
            $right=$request->file('right');

            if($right){
                File::delete($product->right);
                File::delete($product->large_right);
                $fname=rand().'productr.'.$right->getClientOriginalExtension();
                // for small image 
                $path='upload/product/'.$fname;
                $product->right=$path;
                Image::make($right)->resize(290, 290)->save($path);

                // for large image 
                $lpath='upload/product/large/'.$fname;
                Image::make($right)->resize(800, 900)->save($lpath);
                $product->large_right=$lpath;
            }


            $video=$request->file('video');

            if($video){

                $fname=rand().'video.'.$video->getClientOriginalExtension();
                $product->video='upload/product/video/'.$fname;
                // $path=Image::make($file)->resize(200,300);
                $video->move(public_path().'/upload/product/video/',$fname);
            }

            $product->category_id=$request->category;
            $product->subcategory_id=$request->subcategory;
            $product->brand_id=$request->brand;
            $product->sku=$request->sku;
            $product->product_id=$request->product_id;
            $product->price=$request->price;
            $product->offer_price=$request->offer_price;
            $product->name=$request->name;
            $product->delivery_time=$request->delivery_time;
            $product->delivery_charge=$request->delivery_charge;
            $product->featured=$request->featured;
            $product->top_rated=$request->top_rated;
            $product->bestseller=$request->bestseller;
            $product->short_desc=$request->short_description;
            $product->detail=$request->long_description;
            $product->qty=$request->quantity;
            $product->hsn_id=$hsn;
            $product->meta_title=$request->meta_title;
            $product->meta_descr=$request->meta_description;
            $product->meta_keyword=$request->meta_keyword;
            $product->term=$request->term;
            $product->Isrefundable=$request->isrefundable;
            $product->slug=$request->slug;
            $product->weight=$request->weight;
            $product->height=$request->height;
            $product->width=$request->width;
            $product->length=$request->length;

            if($product->save()){
                // updating color and image
                if(isset($request->color)){
              $clength=count($request->color);
              for ($i=0; $i<$clength; $i++) {
                  $color=Productcolor::find($request->cid)["$i"];
                  $color->color=$request->color[$i];
                  if(isset($request->file('color_image')[$i])){

                  $image=$request->file('color_image')[$i];
                  if($image){
                    $fname=rand().'color.'.$image->getClientOriginalExtension();
                    $color->image='upload/product/color/'.$fname;
                    $lpath='upload/product/color/'.$fname;
                    Image::make($image)->resize(800, 900)->save($lpath);
                    $color->large_image=$lpath;
                    $image->move(public_path().'/upload/product/color/',$fname);
                }
            }

                $color->save();
              }
            }

                  // updating variation
                  if(isset($request->size)){
                  $slength=count($request->size);
                  for ($i=0; $i <$slength; $i++) {
                 $size=Productvariation::find($request->sid)["$i"];
                      $size->size=$request->size["$i"];
                      $size->price=$request->size_price["$i"];
                      $size->offer_price=$request->size_offer_price["$i"];
                      $size->qty=$request->size_qty["$i"];
                      $size->save();
                  }
                }
       // storing color and image
       if(isset($request->morecolor)){

       $clength=count($request->morecolor);
       for ($i=0; $i<$clength; $i++) {
           $color=new Productcolor;
           $color->color=$request->morecolor[$i];
           $color->product_id=$request->id;
           $image=$request->file('morecolor_image')[$i];

           if($image){

             $fname=rand().'color.'.$image->getClientOriginalExtension();
             $color->image='upload/product/color/'.$fname;
             $lpath='upload/product/color/'.$fname;
             Image::make($image)->resize(800, 900)->save($lpath);
             $color->large_image=$lpath;
             $image->move(public_path().'/upload/product/color/',$fname);
         }
         $color->save();
       }
    }


           // storing variation
       if(isset($request->moresize)){

           $slength=count($request->moresize);
           for ($i=0; $i <$slength; $i++) {
               $size=new Productvariation;
               $size->size=$request->moresize["$i"];
              $size->product_id=$request->id;
               $size->price=$request->moresize_price["$i"];
               $size->offer_price=$request->moresize_offer_price["$i"];
               $size->qty=$request->moresize_qty["$i"];
               $size->save();
           }

        }
                $notification=array(
                    'alert-type'=>'success',
                    'messege'=>'Product  Updated',

                 );
                 return redirect()->route('vendor.product')->with($notification);
            }else{
                $notification=array(
                    'alert-type'=>'info',
                    'messege'=>'Product  not updated',

                 );
                 return redirect()->back()->with($notification);
            }


        // } catch (\Throwable $th) {
        //     $notification=array(
        //         'alert-type'=>'error',
        //         'messege'=>'Something went wrong. Please try again later.',

        //      );
        //      return redirect()->back()->with($notification);

        // }

    }




    public function deactiveproduct(){
        $product=DB::table('products')->join('categories','categories.id','products.category_id')->select('products.*','categories.category')->orderBy('products.id','desc')->where('products.status',0)->where('vendor_id',Auth::user()->id)->get();
        return view('vendorpanel.product.deactiveproduct',compact('product'));
        }





        public function slug($value){
            $slug = SlugService::createSlug(Product::class, 'slug', $value);
           return response()->json($slug);
          }




          public function Subcategory($id){
                $sub=Subcategory::where('category_id',$id)->get();
                $data='';

            foreach ($sub as $value) {
                $data.="<option value='".$value->id."'>".$value->subcategory."</option>";
            }
                        return response()->json($data);
            }

            public function Brand($category,$subcategory){
                $sub=Brand::where('category_id',$category)->where('subcategory_id',$subcategory)->get();
                $data='';

            foreach ($sub as $value) {
                $data.="<option value='".$value->id."'>".$value->brand."</option>";
            }
                        return response()->json($data);
            }





}
