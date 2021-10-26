@push('style')
<style>
    input[type=checkbox]{
        height: 40px!important;
        width: 40px!important;

    }
</style>

@endpush
@extends('member.master')

@php
       define('PAGE','pin')
@endphp
@section('main-content')
<div class="container-fluid">


    <div class="row">


        <div class="col-md-12 col-xl-12">
<div class="card">
                    <h3 class=" mb-0">Transfer  E-pin History</h3>


        <div class="card-body">




            <table id="myTable" class="table table-reponsive table-striped">
                <thead>
                    <th>#</th>
                    <th>E-pin</th>
                    <th>Username (Transfer To)</th>
                    <th>Name (Transfer To)</th>


                    <th>Status</th>
                    <th>Package</th>

                    <th>Created On</th>



                </thead>
                <tbody>
                    @foreach ($pin as $item)

                    <tr>
                        <td>{{$loop->iteration}}</td>
                <td>{{$item->epin}}</td>
                <td>{{$item->receiver}}</td>

                <td>

                    {{DB::table('users')->where('userid',$item->receiver)->value('name')}}
                </td>

                <td>
                    @if ($item->status=='Unused')
                        <span class="badge bg-danger">unused</span>
                        @else
                        <span class="badge bg-success">used</span>

                    @endif
                </td>
                <td>
                    @if ($item->package==1)
                        <span class="badge bg-info">Package-1000</span>
                        @else
                        <span class="badge bg-info">Package-650</span>

                    @endif
                </td>
                <td>{{carbon\carbon::parse($item->created_at)->format('d F Y')}}</td>



                    </tr>
                    @endforeach

            </table>
        </div>
            </div>
        </div>
    </div>

</div>
@endsection
