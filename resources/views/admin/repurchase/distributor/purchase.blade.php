@php
       define('PAGE','distributor')
@endphp
@extends('admin.master')
@section('main-content')
<div class="container">
    <div class="card">
        <h3>Purchase Report of Super Distributor {{ $super->email }}</h3>
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


        @foreach ($order as $item)
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
    <a href="{{route('admin.distributor.order.show',['id'=>$item->id,'orderId'=>$item->order_id])}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
    <a href="{{route('admin.distributor.order.print',['id'=>$item->id,'orderId'=>$item->order_id])}}" class="btn btn-danger mr-2"><i class="fas fa-print"></i>Print</a>


</td>
</tr>

      @endforeach
    </tbody>
</table>
</div>
<a href="{{route('admin.distributor')}}" class="btn btn-info">Back</a>

    </div>
</div>


@endsection
