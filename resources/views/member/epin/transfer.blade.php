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
                    <h3 class=" mb-0">Transfer E-pin</h3>
           <x-errormsg/>

<form action="{{route('member.epin.store')}}" method="POST">
    @csrf
    <div class="card-body px-5">

    <div class="form-group my-2">
        <label >User Id <span class="text-danger" >*</span></label>
        <input type="text" class="form-control" name="user_id" required value=" ">

    </div>
    <div class="form-group mt-4">
        <input type="submit" class="form-control" value="Transfer">

    </div>

               </div>
        <div class="card-body">
            <table id="myTable" class="table table-reponsive table-striped">
                <thead>
                    <th>Select</th>
                    <th>#</th>
                    <th>E-pin</th>
                    <th>Status</th>
                     <th>Package</th>
                    <th>Created On</th>



                </thead>
                <tbody>
                    @foreach ($pin as $item)
                    @php
                          $epin=DB::table('epintransfers')->where('epintransfers.epin_id',$item->id)->latest()->first();
                    @endphp
                    @if ($epin->receiver==Auth::user()->userid)

                    <tr>
                        <td><input type="checkbox" value="{{$item->id}}" name="epin[]"></td>
                        <td>{{$loop->iteration}}</td>
                        {{-- <td>{{$item->transfer}}</td> --}}

                <td>{{$item->epin}}</td>
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
                    @endif

                    @endforeach

            </table>
        </div>
</form>
            </div>
        </div>
    </div>

</div>
@endsection


