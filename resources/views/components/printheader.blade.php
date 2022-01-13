<style>
    th,td{
        font-size: 14px!important;
    }
    .print_header{
        display: none;
    }
    @media print{
        body{
            visibility: hidden;

        }
        #purchaselist{
            visibility: visible!important;
            margin-top:-25rem!important ;
        }
        #saleslist{
            visibility: visible!important;
            margin-top:-25rem!important ;
        }
        .d_none{
            display: none;
        }
        .print_header{
        display: block!important;
    }

    }
</style>
<div class="print_header">
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
<center >
    <img src="{{__getimagePath($website->image)}}" alt="" class="img-fluid " width="100">
    <h1> <span class='text-danger  py-0 my-0'>Jajba</span><span class='text-info'>Shop</span></h1>
</center>
<br>
</div>