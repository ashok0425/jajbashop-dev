<?php
namespace App\Exports;

use App\Models\Shipment;
use App\Models\Vendor;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
class VendorExport implements FromView 
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


 }

    public function view(): View
    {
        $data="SELECT * FROM `vendors`   WHERE `id` != '' ";

        if(isset($this->name) && !empty($this->name)){
          $data .="  AND cname LIKE '%$this->name%' ";
      }
        if(isset($this->to) && !empty($this->to) ||isset($this->from) && !empty($this->from)){
            $data .=" AND   created_at BETWEEN '$this->from' AND '$this->to'";
        }
   

        return view('backend.vendor.excel', [
            'vendor' =>DB::select($data)
        ]);
    }
}