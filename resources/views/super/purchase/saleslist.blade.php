<div class="table-responsive">
<table width="100%" class="table table-striped table-bordered table-hover" >
    <thead>
    <tr>
        <th>S.N.</th>
        <th>Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
        <th class="d_none">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1 ?>
    @foreach($sales as $pc)
        <tr>
            <th> {{$i++}}</th>
            <td>{{$pc->name}} </td>
            <td>{{$pc->price}} </td>

            <td> {{$pc->qty}}</td>
            <td>{{$pc->price*$pc->qty}} </td>

            <td class="d_none">


                    <a  class="btn btn-danger delete-sales "   data-id="{{$pc->id}}"><i class="fas fa-trash" ></i></a>
                </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="4">Grand Total</td>
        <td>
            <?php $total=0 ?>
                @if($sales)
                    @foreach($sales as $s)
                        @php

                        $total += $s->price*$s->qty;
                        @endphp
                    @endforeach
                    {{$total}}
                @endif
        </td>
        <td></td>
    </tr>
    </tbody>
</table>
</div>