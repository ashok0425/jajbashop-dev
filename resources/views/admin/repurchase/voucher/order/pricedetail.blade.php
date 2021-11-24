<div class="row">
    <div class="col-6">
     Fixed price
    </div>
        <div class="col-6">{{ __getPriceunit()  }} {{ $detail->price }}</div>
        

    </div>
<hr>

<div class="row">
    <div class="col-6">
     Delivery Charge
    </div>
    <div class="col-6">
  + {{ __getPriceunit()  }} {{$charge= $detail->charge }}
       

    </div>
</div>
<hr>

<div class="row">
    <div class="col-6">
     GST(@ {{ $detail->gst }}%)
    </div>
    <div class="col-6">
    {{ __getPriceunit()  }} {{ $gst=($detail->gst*$detail->price)/100 }}

    </div>
</div>
<hr>
<div class="row">
    <div class="col-6">
     Comission(@ {{ $detail->comission }}%)
    </div>
    <div class="col-6">
 - {{ __getPriceunit()  }} {{ $comission=($detail->comission*$detail->price)/100 }}
   
</div>
</div>
<hr>
<div class="row">
    <div class="col-6">
     Logistic Charge
    </div>
    <div class="col-6">
 - {{ __getPriceunit()  }} {{ $detail->logistic }}
   
</div>
</div>

<hr>

<div class="row">
    <div class="col-6">
     <strong>Settlement Value</strong>
    </div>
    <div class="col-6">
    {{ __getPriceunit()  }} <strong>
        {{ $detail->price+$charge-$gst-$comission}}
    </strong>
    
      

    </div>
</div>

<hr>
<div class="row">
    <div class="col-6">
     <strong>Payment Type</strong>
    </div>
    <div class="col-6">
    <strong>
        {{ Str::upper($detail->payment_type)}}
    </strong>
    
      

    </div>
</div>