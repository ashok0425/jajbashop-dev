


@extends('member.master')

@php
       define('PAGE','account')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">All Level Income Detail</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>
        <th>Level</th>

        <th>Amount</th>

        <th>Detail</th>
        <th>Date</th>


    </thead>
    <tbody>
@foreach ($income as $item)

<tr>
    <td>{{$loop->iteration}}</td>

    @if ($item->l1==Auth::user()->userid)
    <td>Level 1</td>
    @endif

    @if ($item->l2==Auth::user()->userid)
    <td>Level 2</td>

    @endif
    @if ($item->l3==Auth::user()->userid)
    <td>Level 3</td>

    @endif
    @if ($item->l4==Auth::user()->userid)
    <td>Level 4</td>

    @endif
    @if ($item->l5==Auth::user()->userid)
    <td>Level 5</td>

    @endif

    @if ($item->l6==Auth::user()->userid)
    <td>Level 6</td>

    @endif
    @if ($item->l7==Auth::user()->userid)
    <td>Level 7</td>

    @endif

    @if ($item->l8==Auth::user()->userid)
    <td>Level 8</td>

    @endif
    @if ($item->l9==Auth::user()->userid)
    <td>Level 9</td>

    @endif
    @if ($item->l10==Auth::user()->userid)
    <td>Level 10</td>

    @endif

    @if ($item->l1==Auth::user()->userid)
    <td>{{$item->el1}}</td>
    @endif

    @if ($item->l2==Auth::user()->userid)
    <td>{{$item->el2}}</td>
    @endif
    @if ($item->l3==Auth::user()->userid)
    <td>{{$item->el3}}</td>
    @endif
    @if ($item->l4==Auth::user()->userid)
    <td>{{$item->el4}}</td>
    @endif
    @if ($item->l5==Auth::user()->userid)
    <td>{{$item->el5}}</td>
    @endif

    @if ($item->l6==Auth::user()->userid)
    <td>{{$item->el6}}</td>
    @endif
    @if ($item->l7==Auth::user()->userid)
    <td>{{$item->el7}}</td>
    @endif

    @if ($item->l8==Auth::user()->userid)
    <td>{{$item->el8}}</td>
    @endif
    @if ($item->l9==Auth::user()->userid)
    <td>{{$item->el9}}</td>
    @endif
    @if ($item->l10==Auth::user()->userid)
    <td>{{$item->el10}}</td>
    @endif

    <td>Referral level Income for joining of user   <b> {{DB::table('users')->where('id',$item->user_id)->value('userid')}}</b></td>
    <td>{{carbon\carbon::parse($item->created)->format('d F Y')}}</td>

</tr>
@endforeach


    </tbody>
</table>
</div>
    </div>

</div>
@endsection
