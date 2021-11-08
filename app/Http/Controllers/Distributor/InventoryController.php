<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shipping;
use App\Models\Distributor;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use File;
use App\Models\Inventory;
use App\Models\Account;

class InventoryController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;

    public function index()
    {
        $product=DB::table('inventories')->leftjoin('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','inventories.product_id')->select('jajbashop_ecommerce.products.*')->where('inventories.buyer',2)->where('inventories.user_id',__getDist()->id)->select('jajbashop_ecommerce.products.name','jajbashop_ecommerce.products.image','jajbashop_ecommerce.products.id as pid','inventories.*')->orderBy('inventories.id','desc')->get();

       return view('distributor.inventory.index',compact('product'));
    }





}
