<?php

namespace App\Imports;

use App\Models\Shipment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use session;
class ShipmentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $phone=$row['phone'];
        session()->flash('msg','file uploaded');
        $latestOrder = DB::table('shipments')->orderBy('id','desc')->first();
        $order = '#BEL'.str_pad($latestOrder->id + 1, 6, "0", STR_PAD_LEFT);
        return new Shipment([
            'vendor_id'=>__getVendor()->id,
            'pickup_loctaion'=>$row['pickup_location'],
            'name'=>$row['name'],
            'phone'=>"$phone",
            'address'=>$row['address'],

            'weight'=>$row['weight'],
            'unit'=>$row['unit'],
            'amount'=>$row['amount'],
            'date'=>date('Y-m-d'),
            'order_id'=>$order,

        ]);

    }
}
