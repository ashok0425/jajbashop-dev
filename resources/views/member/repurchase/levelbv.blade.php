@extends('member.master')

@php
       define('PAGE','repurchase')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Level wise BV Detail</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>

        <th>Level</th>
        <th>Total BV</th>
        <th>Action</th>


    </thead>
    <tbody>

        <tr>
            <td>1</td>
            <td>Level 1</td>
             <td>
@php
    $member=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l1',Auth::user()->userid)->sum('levelbvs.l1');
@endphp
{{$member}}
             </td>

<td><a href="{{route('member.level.bv.show',['level'=>1])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>




        <tr>
            <td>2</td>
            <td>Level 2</td>
             <td>
@php
    $member=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l2',Auth::user()->userid)->sum('levelbvs.l2');
@endphp
{{$member}}
             </td>

<td><a href="{{route('member.level.bv.show',['level'=>2])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


        <tr>
            <td>3</td>
            <td>Level 3</td>
             <td>
@php
    $member=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l3',Auth::user()->userid)->sum('levelbvs.l3');
@endphp
{{$member}}
             </td>

<td><a href="{{route('member.level.bv.show',['level'=>3])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


        <tr>
            <td>4</td>
            <td>Level 4</td>
             <td>
@php
    $member=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l4',Auth::user()->userid)->sum('levelbvs.l4');
@endphp
{{$member}}
             </td>

<td><a href="{{route('member.level.bv.show',['level'=>4])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


        <tr>
            <td>5</td>
            <td>Level 5</td>
             <td>
@php
    $member=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l5',Auth::user()->userid)->sum('levelbvs.l5');
@endphp
{{$member}}
             </td>

<td><a href="{{route('member.level.bv.show',['level'=>5])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


        <tr>
            <td>6</td>
            <td>Level 6</td>
             <td>
@php
    $member=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l6',Auth::user()->userid)->sum('levelbvs.l6');
@endphp
{{$member}}
             </td>

<td><a href="{{route('member.level.bv.show',['level'=>6])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


        <tr>
            <td>7</td>
            <td>Level 7</td>
             <td>
@php
    $member=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l7',Auth::user()->userid)->sum('levelbvs.l7');
@endphp
{{$member}}
             </td>

<td><a href="{{route('member.level.bv.show',['level'=>7])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>8</td>
            <td>Level 8</td>
             <td>
@php
    $member=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l8',Auth::user()->userid)->sum('levelbvs.l8');
@endphp
{{$member}}
             </td>

<td><a href="{{route('member.level.bv.show',['level'=>8])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>9</td>
            <td>Level 9</td>
             <td>
@php
    $member=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l9',Auth::user()->userid)->sum('levelbvs.l9');
@endphp
{{$member}}
             </td>

<td><a href="{{route('member.level.bv.show',['level'=>9])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>10</td>
            <td>Level 10</td>
             <td>
@php
    $member=DB::table('levels')->join('levelbvs','levelbvs.user_id','levels.user_id')->where('levels.l10',Auth::user()->userid)->sum('levelbvs.l10');
@endphp
{{$member}}
             </td>

<td><a href="{{route('member.level.bv.show',['level'=>10])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>



</table>
</div>
    </div>
    <a href="{{route('member.income.level')}}" class="btn btn-info">Back</a>

</div>
@endsection
