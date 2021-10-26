<div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    

@php
            use carbon\carbon;
    $s1=DB::table('shipments')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->day)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->count();
   
    $s2=DB::table('shipments')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(1))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->count();

    $s3=DB::table('shipments')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(2))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->count();
   
    $s4=DB::table('shipments')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(3))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->count();
   
    $s5=DB::table('shipments')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(4))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->count();
   
    $s6=DB::table('shipments')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(5))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->count();
   
    $s7=DB::table('shipments')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(6))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->count();
   
   

@endphp
        
        <?php
        $D1=date('D');
        $D2=date('D',strtotime('-1 day'));
        $D3=date('D',strtotime('-2 day'));
        $D4=date('D',strtotime('-3 day'));
        $D5=date('D',strtotime('-4 day'));
        $D6=date('D',strtotime('-5 day'));
        $D7=date('D',strtotime('-6 day'));
        
        
    
         
        ?>
            @php
                $m1=DB::table('shipments')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->where('vendor_id',__getVendor()->id)->count();
        $m2=DB::table('shipments')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->where('vendor_id',__getVendor()->id)->count();
        $m3=DB::table('shipments')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->where('vendor_id',__getVendor()->id)->count();
            @endphp
        
        @php
        $c1=DB::table('vendorpays')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->sum('total');
$c2=DB::table('vendorpays')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->where('vendor_id',__getVendor()->id)->sum('total');
$c3=DB::table('vendorpays')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->where('vendor_id',__getVendor()->id)->sum('total');
    @endphp
    
        <?php
        $M1=date('M');
        
        $M2=date('M',strtotime('-1 month'));
        $M3=date('M',strtotime('-2 month'));
    
        ?>
         
         @php
          $v1=DB::table('vendorpays')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->day)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->sum('total');
               
               $v2=DB::table('vendorpays')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(1))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->sum('total');

               $v3=DB::table('vendorpays')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(2))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->sum('total');
              
               $v4=DB::table('vendorpays')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(3))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->sum('total');
              
               $v5=DB::table('vendorpays')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(4))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->sum('total');
              
               $v6=DB::table('vendorpays')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(5))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->sum('total');
              
               $v7=DB::table('vendorpays')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',carbon::now()->month)->whereDay('created_at',carbon::now()->subDay(6))->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('vendor_id',__getVendor()->id)->sum('total');
     @endphp
    
    
    
    <?php
    $V1=date('M');
    
    $V2=date('M',strtotime('-1 month'));
    $V3=date('M',strtotime('-2 month'));
    
    ?>
    
    
        <script>
          window.onload = function () {
          
        
           
          var chart4 = new CanvasJS.Chart("chartContainer4", {
              title: {
                  text: "Shipment Report of First 3 Month's"
              },
              axisY: {
                  title: "Number of Shipment"
              },
              data: [{
                  type: "area",
                  markerSize: 5,
                  dataPoints:  [
            { label: "<?php echo $M3 ?>",  y: <?php echo $m3 ?>},
            { label:"<?php echo $M2 ?>", y: <?php echo $m2 ?>  },
            { label: "<?php echo $M1 ?>", y: <?php echo $m1 ?>  },
         
        ]
              }]
          });
        
           

          var chart2 = new CanvasJS.Chart("chartContainer2", {
              title: {
                  text: "Collection Report of First 3 Month's"
              },
              axisY: {
                  title: "Collection"
              },
              data: [{
                  type: "area",
                  markerSize: 5,
                  dataPoints:  [
            { label: "<?php echo $M3 ?>",  y: <?php echo $c3 ?>},
            { label:"<?php echo $M2 ?>", y: <?php echo $c2 ?>  },
            { label: "<?php echo $M1 ?>", y: <?php echo $c1 ?>  },
         
        ]
              }]
          });
        
          


          var chart5 = new CanvasJS.Chart("chartContainer5", {
              title: {
                  text: "Shipment Graph's of Current week"
              },
              axisY: {
                  title: "Shipment Number"
              },
              data: [{
                type: "column", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                  dataPoints: [
                  { label: "<?php echo $D7 ?>",  y: <?php echo $s7 ?>},
                  { label: "<?php echo $D6 ?>",  y: <?php echo $s6 ?>},
                  { label: "<?php echo $D5 ?>",  y: <?php echo $s5 ?>},
                  { label: "<?php echo $D4 ?>",  y: <?php echo $s4 ?>},
                  { label: "<?php echo $D3 ?>",  y: <?php echo $s3 ?>},
                  { label: "<?php echo $D2 ?>",  y: <?php echo $s2 ?>},
                  { label: "<?php echo $D1 ?>",  y: <?php echo $s1 ?>},
                  ]
            
              }]
          });
    
                 
          var chart1 = new CanvasJS.Chart("chartContainer1", {
              title: {
                  text: "Collection Report of  current week's"
              },
              axisY: {
                  title: "Number of collection"
              },
              data: [{
                type: "column",
        
                  dataPoints:  [
                    { label: "<?php echo $D1 ?>",  y: <?php echo $v7 ?>},
                  { label: "<?php echo $D2 ?>",  y: <?php echo $v6 ?>},
                  { label: "<?php echo $D3 ?>",  y: <?php echo $v5 ?>},
                  { label: "<?php echo $D4 ?>",  y: <?php echo $v4 ?>},
                  { label: "<?php echo $D5 ?>",  y: <?php echo $v3 ?>},
                  { label: "<?php echo $D6 ?>",  y: <?php echo $v2 ?>},
                  { label: "<?php echo $D7 ?>",  y: <?php echo $v1 ?>},
         
        ]
              }]
          });
          chart1.render();
          chart2.render();
        //   chart3.render();
          chart4.render();
          chart5.render();

    
    
           
          }
          </script>
</div>