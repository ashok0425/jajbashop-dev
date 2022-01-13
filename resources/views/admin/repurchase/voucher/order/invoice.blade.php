@php
    $website=DB::table('websites')->first();
    $ship=DB::table('shippings')->where('order_id',$order_id)->first();
    $bill=DB::table('billings')->where('order_id',$order_id)->first();
    $product=DB::table('order_details')->join('products','products.id','order_details.product_id')->where('order_id',$order_id)->where('vendor_order_id',$vendor_order_id)->select('order_details.*','products.name','products.image','products.width','products.weight','products.height','products.length')->first();

    $seller=DB::connection('mysql2')->table('users')->where('id',$product->vendor_id)->first();

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('invoice/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('invoice/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('invoice/css/print.css')}}">
    <title>Tax Invoice</title>
</head>

<body class="custom-text-black custom-body">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-6 page px-0">
                    <section class="ship-to my-3">
                        <div class="row px-3">
                            <div class="col-6 my-3">
                                <div class="img-wrap mb-2">
                                  {{-- @php
                                        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />';
                                  @endphp --}}
                                </div>
                                <div class="address-1 custom-fw-700">
                                    <p class="custom-fs-25 ">Ship To: <span class="ms-4">AWB 265744836999</span>
                                    </p>
                                    <p class="custom-fs-20 custom-fw-700 ms-2">Ashish,S/O Prof. Satyaendra Kumar
                                        Yadav
                                    </p>
                                    <p class="custom-fs-20 custom-fw-700 ms-2 lh-sm">133</p>
                                    <p class="custom-fs-20 custom-fw-700 ms-2 lh-sm">War No12 MURLIGANJ 852122
                                    </p>
                                    <p class="custom-fs-20 custom-fw-700 ms-2 lh-sm">BIHAR</p>
                                    <p class="custom-fs-20 custom-fw-700 ms-2 lh-sm">Landmark: N.H 107, Near,
                                        -SBI</p>
                                    <p class="custom-fs-20 custom-fw-700 ms-2 lh-sm">NDL:</p>
                                </div>
                            </div>
                            <div class="col-6 justify-content-start">
                                <div class="sur text-center">
                                    <h2 class="custom-fs-35 custom-fw-700 lh-lg  border border-2 border-dark">
                                        SUR</h2>
                                    <p class="custom-fs-28 custom-fw-500  border border-2 border-top-0 border-dark">
                                        0.21
                                        Kgs</p>
                                    <div class="border border-2 border-top-0 border-dark" style="height: 30px;">
                                    </div>
                                    <h2
                                        class="custom-fs-35 custom-fw-700 lh-lg  border border-2 border-dark border-top-0">
                                        09/09</h2>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="ship-date border-bottom border-2 border-dark py-2">
                        <div class="row px-3">
                            <div class="col-6 mb-4 ">
                                <div class="text-wrap d-flex flex-column justify-content-end h-100">
                                    <p class="custom-fs-20 custom-fw-700 ms-2 lh-sm">Order Id:
                                        402-4396264-8434700</p>
                                    <p class="custom-fs-20 custom-fw-700 ms-2 lh-sm">Ship Date: 03 Sep 2021</p>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="d-flex text-center">
                                    <h2 class="custom-fs-35 custom-fw-700  border border-2 border-dark  px-1 ">
                                        <p class="custom-fs-16 custom-fw-500">DELIVERY <br> STATION</p>
                                        BRPM</P>
                                    </h2>
                                    <div
                                        class="custom-fs-35 custom-fw-700  border border-2 border-dark mb-0 px-1  custom-bg-black custom-text-white">
                                        <p class="custom-fs-16 custom-fw-500">SECTOR</p>
                                        <P>X</P>
                                    </div>
                                    <div class="custom-fs-35 custom-fw-700  border border-2 border-dark mb-0 px-1  ">
                                        <p class="custom-fs-16 custom-fw-500">GEOZONE</p>
                                        <P>X</P>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="ship-from  p-3">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-center mb-4">
                                <div class="img-wrap align-self-center">
                                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150" alt="" class="img-fluid" >
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="shipment-details">
                                    <h2 class="custom-fs-30 custom-fw-700 lh-1 ">Ship From:</h2>
                                    <p class="custom-fs-30 custom-fw-500 lh-sm"> SPARKEL INDIA</p>
                                    <h2 class="custom-fs-30 custom-fw-700 lh-1 ">Return Address:</h2>
                                    <p class="custom-fs-30 custom-fw-500 lh-sm"> T-508 WAZIRABAD SECTOR-52</p>
                                    <p class="custom-fs-30 custom-fw-500 lh-sm"> NEAR SHIV MANDIR, MANISH</p>
                                    <p class="custom-fs-30 custom-fw-500 lh-sm"> KIRANA STORE GURUGRAM,</p>
                                    <p class="custom-fs-30 custom-fw-500 lh-sm"> HARYANA 122018</p>
                                    <p class="custom-fs-30 custom-fw-500 lh-sm"> India</p>
                                </div>
                            </div>
                            <div class="col-3 d-flex justify-content-center mb-4">
                                <div class="img-wrap align-self-center">
                                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150" alt="" class="img-fluid" >
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="px-3">

                        <p class="custom-fs-30 custom-fw-300 lh-sm mb-3">Customer Self Declaration : the goods
                            sold are
                            intended
                            for
                            end user consumption. Not for resale.</p>

                        <div class="table-responsive mb-2">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border border-2 border-dark">#</th>
                                        <th scope="col" class="border border-2 border-dark">SELLER</th>
                                        <th scope="col" class="border border-2 border-dark">GSTIN</th>
                                        <th scope="col" class="border border-2 border-dark">INVOICE#</th>
                                        <th scope="col" class="border border-2 border-dark">DATE</th>
                                        <th scope="col" class="border border-2 border-dark">ITEM TYPE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row" class="border border-2 border-dark">1</td>
                                        <td class="border border-2 border-dark"></td>
                                        <td class="border border-2 border-dark"></td>
                                        <td class="border border-2 border-dark"></td>
                                        <td class="border border-2 border-dark"></td>
                                        <td class="border border-2 border-dark"></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="border border-2 border-dark">2</td>
                                        <td class="border border-2 border-dark"></td>
                                        <td class="border border-2 border-dark"></td>
                                        <td class="border border-2 border-dark"></td>
                                        <td class="border border-2 border-dark"></td>
                                        <td class="border border-2 border-dark"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </section>

                    <section>
                        <div class="table-responsive mb-3 px-3">
                            <table class="table" style="width: max-content">
                                <tbody>
                                    <tr>
                                        <td class="border border-2 border-dark custom-fs-30 custom-fw-700">
                                            <p>DLIQ</p>
                                            <p><span class="custom-bg-black custom-text-white px-2">U</span>003
                                            </p>
                                        </td>
                                        <td class="border border-2 border-dark custom-fs-30 custom-fw-700">
                                            <p>NCRU</p>
                                            <p><span class="custom-bg-black custom-text-white px-2">A</span>18Y
                                            </p>
                                        </td>
                                        <td class="border border-2 border-dark custom-fs-30 custom-fw-700">
                                            <p>PATX</p>
                                            <p><span class="custom-bg-black custom-text-white px-2">D</span>006
                                            </p>
                                        </td>
                                        <td class="border border-2 border-dark custom-fs-30 custom-fw-700">
                                            <p>BRPM</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row px-3">
                            <div class="col-7">
                                <p>Sold on: www.amazon.in</p>
                            </div>
                            <div class="col-5">
                                <h2 class="custom-fs-30 custom-fw-700">ATSPL</h2>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-6 page px-0">
                    <div class="py-2">
                        <section class="px-3 mb-5">
                            <div class="row">
                                <div class="col-6">
                                    <div class="logo">
                                        <div class="img-wrap">
                                            <img src="{{__getimagePath($webiste->image)}}" alt="baratodeal.in" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h1 class="custom-fs-30 custom-fw-700">Tax Invoice/Cash Memo
                                        </h1>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-4">
                                    <p class="custom-fs-25 custom-fw-700 ">Sold By :</p>
                                    <p class="custom-fs-25 custom-fw-500 ">SPARKEL INDIA</p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">* T -508 WAZIRABAD SECTOR-52 NEAR
                                        SHIV</p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">MANDIR,, MANISH KIRANA STORE</p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">GURUGRAM, HARYANA, 122018</p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">IN</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="custom-fs-25 custom-fw-700 ">Billing Address :</p>
                                    <p class="custom-fs-25 custom-fw-500 ">Ashish,S/O Prof. Satyendra Kumar Yadav
                                    </p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">133, Ward No12</p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">MURLIGANJ, BIHAR, 852122</p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">IN</p>
                                    <p class="custom-fs-25 custom-fw-700 ">Billing Address : <span
                                            class="custom-fw-500">10</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="custom-fs-25 custom-fw-700">PAN No : <span
                                            class="custom-fw-500">JCBPS5335A</span>
                                    </p>
                                    <p class="custom-fs-25 custom-fw-700">GST Registration No : <span
                                            class="custom-fw-500">06JCBPS5335A1ZR</span>
                                    </p>
                                </div>
                                <div class="col-6  text-end">
                                    <p class="custom-fs-25 custom-fw-700">Shipping Address :
                                    </p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">Ashish,S/O Prof. Satyendra Kumar
                                        Yadav
                                    </p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">Ashish,S/O Prof. Satyendra Kumar
                                        Yadav
                                    </p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">133, Ward No12
                                    </p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">MURLIGANJ, BIHAR, 852122
                                    </p>
                                    <p class="custom-fs-25 custom-fw-500 lh-sm">IN</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 align-self-end mb-4">
                                    <p class="custom-fs-25 custom-fw-700">Order Number : <span
                                            class="custom-fw-500">402-4396264-8434700</span>
                                    </p>
                                    <p class="custom-fs-25 custom-fw-700">Order Date : <span
                                            class="custom-fw-500">01.09.2021</span>
                                    </p>
                                </div>
                                <div class="col-6 text-end mb-4">
                                    <p class="custom-fs-25 custom-fw-700">State/UT Code: <span
                                            class="custom-fw-500">10</span>
                                    </p>
                                    <p class="custom-fs-25 custom-fw-700"> Place of supply:<span
                                            class="custom-fw-500">BIHAR</span>
                                    </p>
                                    <p class="custom-fs-25 custom-fw-700"> Place of delivery:<span
                                            class="custom-fw-500">BIHAR</span>
                                    </p>
                                    <p class="custom-fs-25 custom-fw-700">Invoice Number :<span class="custom-fw-500">
                                            IN-2645</span>
                                    </p>
                                    <p class="custom-fs-25 custom-fw-700"> Invoice Details : <span
                                            class="custom-fw-500">HR-1545633835-2122</span>
                                    </p>
                                    <p class="custom-fs-25 custom-fw-700">Invoice Date : <span
                                            class="custom-fw-500">01.09.2021</span>
                                    </p>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border border-2 border-dark">Sl. <br> NO</th>
                                            <th scope="col" class="border border-2 border-dark">Description</th>
                                            <th scope="col" class="border border-2 border-dark">Unit <br>
                                                Price</th>
                                            <th scope="col" class="border border-2 border-dark"> Unit Price</th>
                                            <th scope="col" class="border border-2 border-dark"> Qty</th>
                                            <th scope="col" class="border border-2 border-dark"> Net <br>
                                                Amount</th>
                                            <th scope="col" class="border border-2 border-dark"> Tax <br>
                                                Rate</th>
                                            <th scope="col" class="border border-2 border-dark"> Tax <br>
                                                Type</th>
                                            <th scope="col" class="border border-2 border-dark"> Tax <br>
                                                Amount </th>
                                            <th scope="col" class="border border-2 border-dark">Total <br>
                                                Amount </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope='row' class="border border-2 border-dark">1</td>
                                            <td class="border border-2 border-dark"> Philips Avent 260ml Natural Feeding
                                                Bottle (Clear, Pack of 2) |
                                                B013SIU8Y8 ( 8710103736851 )
                                                HSN:3926</td>
                                            <td class="border border-2 border-dark">
                                                1
                                            </td>
                                            <td class="border border-2 border-dark">₹685.71</td>
                                            <td class="border border-2 border-dark">1</td>
                                            <td class="border border-2 border-dark">₹685.71</td>
                                            <td class="border border-2 border-dark">12%</td>
                                            <td class="border border-2 border-dark">IGST</td>
                                            <td class="border border-2 border-dark">₹82.29</td>
                                            <td class="border border-2 border-dark">₹768.00</td>
                                        </tr>
                                        <tr>

                                            <td class="border border-2 border-dark custom-fw-700" colspan="8">Total
                                                : </td>
                                            <td class="border border-2 border-dark">₹82.29</td>
                                            <td class="border border-2 border-dark">₹768.00</td>
                                        </tr>
                                        <tr>
                                            <td class="border border-2 border-dark custom-fw-700" colspan="10">
                                                Amount in
                                                Words:
                                                <br>
                                                Seven Hundred Sixty-eight only
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border border-2 border-dark custom-fw-700 text-end" colspan="10">
                                                For SPARKEL INDIA: <br>
                                                Authorized Signatory
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>


                            </div>
                            <p>Whether tax is payable under reverse charge - No
                            </p>
                        </section>

                        <section class="text-center custom-fs-8 footer">
                           This is computer generated invoice.
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>