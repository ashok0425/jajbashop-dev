@extends('admin.master')

@php
       define('PAGE','member')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Level wise Earning Detail of Username :- {{$userid}}</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>

        <th>Level</th>
        <th>Total Earning</th>
        <th>Action</th>


    </thead>
    <tbody>

        <tr>
            <td>1</td>
            <td>Level 1</td>
             <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l1',$userid)->sum('levelearnings.l1');
@endphp
{{$member}}
             </td>

<td><a href="{{route('admin.user.income.level.show',['userid'=>$userid,'level'=>1,])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>




        <tr>
            <td>2</td>
            <td>Level 2</td>
             <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l2',$userid)->sum('levelearnings.l2');
@endphp
{{$member}}
             </td>

<td><a href="{{route('admin.user.income.level.show',['userid'=>$userid,'level'=>2])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


        <tr>
            <td>3</td>
            <td>Level 3</td>
             <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l3',$userid)->sum('levelearnings.l3');
@endphp
{{$member}}
             </td>

<td><a href="{{route('admin.user.income.level.show',['userid'=>$userid,'level'=>3])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


        <tr>
            <td>4</td>
            <td>Level 4</td>
             <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l4',$userid)->sum('levelearnings.l4');
@endphp
{{$member}}
             </td>

<td><a href="{{route('admin.user.income.level.show',['userid'=>$userid,'level'=>4])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


        <tr>
            <td>5</td>
            <td>Level 5</td>
             <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l5',$userid)->sum('levelearnings.l5');
@endphp
{{$member}}
             </td>

<td><a href="{{route('admin.user.income.level.show',['userid'=>$userid,'level'=>5])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


        <tr>
            <td>6</td>
            <td>Level 6</td>
             <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l6',$userid)->sum('levelearnings.l6');
@endphp
{{$member}}
             </td>

<td><a href="{{route('admin.user.income.level.show',['userid'=>$userid,'level'=>6])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


        <tr>
            <td>7</td>
            <td>Level 7</td>
             <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l7',$userid)->sum('levelearnings.l7');
@endphp
{{$member}}
             </td>

<td><a href="{{route('admin.user.income.level.show',['userid'=>$userid,'level'=>7])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>8</td>
            <td>Level 8</td>
             <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l8',$userid)->sum('levelearnings.l8');
@endphp
{{$member}}
             </td>

<td><a href="{{route('admin.user.income.level.show',['userid'=>$userid,'level'=>8])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>9</td>
            <td>Level 9</td>
             <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l9',$userid)->sum('levelearnings.l9');
@endphp
{{$member}}
             </td>

<td><a href="{{route('admin.user.income.level.show',['userid'=>$userid,'level'=>9])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>10</td>
            <td>Level 10</td>
             <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l10',$userid)->sum('levelearnings.l10');
@endphp
{{$member}}
             </td>

<td><a href="{{route('admin.user.income.level.show',['userid'=>$userid,'level'=>10])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>



</table>
</div>
    </div>
    <a href="{{route('admin.user.all')}}" class="btn btn-info">Back</a>

</div>
@endsection
