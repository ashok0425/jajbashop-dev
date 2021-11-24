<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Traits\status;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;

    public function index()
    {
        $product=DB::table('inventories')->leftjoin('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','inventories.product_id')->select('alfacode_jajbashop_ecommerce.products.*')->where('inventories.buyer',2)->where('inventories.user_id',__getDist()->id)->select('alfacode_jajbashop_ecommerce.products.name','alfacode_jajbashop_ecommerce.products.image','alfacode_jajbashop_ecommerce.products.id as pid','inventories.*')->orderBy('inventories.id','desc')->get();

       return view('distributor.inventory.index',compact('product'));
    }





}
