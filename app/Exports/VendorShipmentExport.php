<?php
namespace App\Exports;

use App\Models\Shipment;
use App\Models\Vendor;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use Illuminate\Support\Facades\Auth;

class VendorShipmentExport implements FromView 
{
    protected $data;
    protected $from;
    protected $to;
    protected $name;


    function __construct($data) {
        $this->data = $data;
        $this->from=$this->data['from'];
        $this->to=$this->data['to'];
        $this->name=$this->data['name'];
        $this->status=$this->data['status'];

       $this->vendor=__getVendor()->id;
    //    $this->id='';
       
 }

    public function view(): View
    {
        $data="SELECT shipments.*,tracks.name AS sname,riders.name AS rname,vendors.cname AS vname,vendors.id AS vid,packages.price as price,packages.package FROM shipments LEFT JOIN tracks ON shipments.status = tracks.id LEFT JOIN riders ON shipments.rider_id =riders.id LEFT JOIN vendors ON shipments.vendor_id =vendors.id LEFT JOIN packages ON shipments.package_id =packages.id  WHERE shipments.vendor_id = $this->vendor ";

        // if(isset($this->data['vendor']) && !empty($this->data['vendor'])){
        //     $data .="  AND shipments.vendor_id = $this->data['vendor'] ";
        // }
        // if(isset($this->data['rider']) && !empty($this->data['rider'])){
        //     $data .="  AND shipments.rider_id = $this->data['rider'] ";
        // }
         if(isset($this->data['status']) && !empty($this->data['status'])){
            $data .="  AND shipments.status = $this->status ";
        }
        if(isset($this->data['name']) && !empty($this->data['name'])){
          $data .="  AND shipments.name LIKE '%$this->name%' ";
      }
      
        if(isset($this->data['to']) && !empty($this->data['to']) ||isset($this->data['from']) && !empty($this->data['from'])){
            $data .=" AND   shipments.created_at BETWEEN '$this->from' AND '$this->to' ";
        }
        return view('vendorpanel.shipment.excel', [
            'shipment' =>DB::select($data)
        ]);
    }
}