@php
       define('PAGE','inventory')
@endphp
@extends('distributor.master')
   <style>
    input[name='payment'] {
	/* display: none; */
 height: 1.4rem;
 width: 1.4rem;


}
</style>
@section('main-content')
<div class="container">
    <div class="card">
        <h3>Inventory Product List</h3>
        <div class="card-body">
    <table id="myTable" class="table table-striped text-center">
<thead>
    <tr>
        <th>#</th>
        <th>Image</th>
        <th>Category</th>
        <th>Name</th>
        <th>qty(in Stock)</th>
        <th>price</th>
        <th>B.V</th>





    </tr>
</thead>
<tbody>


        @foreach ($product as $item)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>
        <img class="img-fluid" src="{{asset($item->image)}}" alt="{{$item->name}}" width="60">

    </td>
<td>{{$item->category}}</td>
<td>
    {{$item->name}}
</td>
<td>
   @if ($item->qty<=3)
<div class="badge bg-danger">{{$item->qty}}</div>


    @elseif ($item->qty<=6)
<div class="badge bg-warning">{{$item->qty}}</div>

    @elseif ($item->qty<=10)
<div class="badge bg-info">{{$item->qty}}</div>
@else 
<div>{{$item->qty}}</div>

    @endif
</td>
<td>
    {{__getPriceunit() .$item->price}}
</td>
<td>
    {{$item->bv}}
</td>

</tr>

      @endforeach
    </tbody>
</table>
</div>

    </div>
</div>


@endsection
