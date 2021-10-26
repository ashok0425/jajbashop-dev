@extends('admin.master')
@php
       define('PAGE','pin')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Used E-pin</h3>

       <div class="card-body">
        <table id="myTable" class="table table-reponsive table-striped">
            <thead>
               <tr>
                <th>#</th>
                <th>E-pin</th>
                <th>Username (Used By)</th>
                <th>Name</th>


                <th>Status</th>
                <p>Package</p>
                <th>Used on</th>

                <th>Created On</th>
               </tr>



            </thead>
            <tbody>
                @foreach ($pin as $item)

                <tr>
                    <td>{{$loop->iteration}}</td>
            <td>{{$item->epin}}</td>
            <td>{{$item->usedBy}}</td>

            <td>{{ DB::table('users')->where('userid',$item->usedBy)->value('name') }}</td>

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
            <td>{{carbon\carbon::parse($item->used_at)->format('d F Y')}}</td>

            <td>{{carbon\carbon::parse($item->created_at)->format('d F Y')}}</td>



                </tr>
                @endforeach

        </table>
</div>
    </div>

</div>
@endsection
