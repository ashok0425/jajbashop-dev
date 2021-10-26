@php
       define('PAGE','report')
@endphp
@extends('super.master')
@section('main-content')
<div class="container">
    <div class="card">
        <h3>Purchase Report</h3>
        <div class="card-body">
    <table id="myTable" class="table table-striped text-center">
<thead>
    <tr>
        <th>#</th>
        <th>Order ID</th>
        <th> Amount {{__getPriceunit()}}</th>
        {{-- <th> BV</th> --}}
        <th>Action</th>





    </tr>
</thead>
<tbody>


        @foreach ($product as $item)
<tr>
    <td>{{$loop->iteration}}</td>

<td>{{$item->order_id}}</td>

<td>
    {{$item->total}}
</td>
{{-- <td>
    {{$item->bv}}
</td> --}}
<td>
    <a href="{{route('super.report.show',['id'=>$item->id,'orderId'=>$item->order_id])}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
    <a href="{{route('super.report.print',['id'=>$item->id,'orderId'=>$item->order_id])}}" class="btn btn-danger mr-2"><i class="fas fa-print"></i>Print</a>


</td>
</tr>

      @endforeach
    </tbody>
</table>
</div>

    </div>
</div>


@endsection