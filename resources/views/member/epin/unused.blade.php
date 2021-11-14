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


        <div class="card-body">
            <table id="myTable" class="table table-reponsive table-striped">
                <thead>
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
              @if (strtolower($epin->receiver)==strtolower(Auth::user()->userid))


                    <tr>
                        <td>{{$loop->iteration}}</td>
                        {{-- <td>{{$item->transfer}}</td> --}}

                <td>{{$item->epin}}</td>
                <td>
                    @if ($item->status=='Unused')
                        <span class="badge bg-danger">unused</span>
                        @else
                        <span class="badge bg-success">used</span>

                    @endif

                        <div class="btn btn-primary epin_btn" data-toggle="modal" data-target="#exampleModal" data-id="{{$item->epin}}">Use Now</div>
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
            </div>
        </div>
    </div>

</div>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Active Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('member.activation')}}" method="POST">
            @csrf
            <input type="hidden" name="activefromepin" value="1">
            <input type="text"  readonly  name="epin" id="epin" class="form-control">
        <div class="modal-body">
<div class="form-group">
<input type="text" class="form-control sponsor_id" name="userid"  autocomplete="off">
<div class="name mt-1 text-success text-center"></div>
</div>
<br>
<input type="submit" value="submit" class="form-control">
        </div>
    </form>

      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){

     $(document).on('click','.epin_btn',function(){

         $userid=$(this).data('id');

         $('#epin').val($userid);

     })
    })
</script>
@endpush



@push('scripts')
<script>
    $('.sponsor_id').keyup(function(){
        $('.name').html('')
        let value=$(this).val();
        $.ajax({
            url:'{{ url('member/load-sponsor-data')}}/'+value,
            type:"GET",
            success:function(data){
                    $('.name').html(data)

               
            }
        })
    })
</script>
    
@endpush