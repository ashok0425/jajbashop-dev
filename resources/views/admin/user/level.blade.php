@extends('admin.master')

@php
       define('PAGE','member')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Level wise Member Count of username:- {{$id}}</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>

        <th>Level</th>
        <th>No. of Member</th>
        <th>Action</th>


    </thead>
    <tbody>

        <tr>
            <td>1</td>
            <td>Level 1</td>
             <td>
@php
    $member=DB::table('levels')->where('l1',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('admin.user.level.show',['id'=>$id,'level'=>1])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>
        <tr>
            <td>2</td>
            <td>Level 2</td>
             <td>
@php
    $member=DB::table('levels')->where('l2',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>2])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>3</td>
            <td>Level 3</td>
             <td>
@php
    $member=DB::table('levels')->where('l3',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>3])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>4</td>
            <td>Level 4</td>
             <td>
@php
    $member=DB::table('levels')->where('l4',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>4])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>5</td>
            <td>Level 5</td>
             <td>
@php
    $member=DB::table('levels')->where('l5',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>5])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>6</td>
            <td>Level 6</td>
             <td>
@php
    $member=DB::table('levels')->where('l6',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>6])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>7</td>
            <td>Level 7</td>
             <td>
@php
    $member=DB::table('levels')->where('l7',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>7])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>8</td>
            <td>Level 8</td>
             <td>
@php
    $member=DB::table('levels')->where('l8',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>8])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>9</td>
            <td>Level 9</td>
             <td>
@php
    $member=DB::table('levels')->where('l9',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>9])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>10</td>
            <td>Level 10</td>
             <td>
@php
    $member=DB::table('levels')->where('l10',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>10])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>11</td>
            <td>Level 11</td>
             <td>
@php
    $member=DB::table('levels')->where('l11',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>11])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>12</td>
            <td>Level 12</td>
             <td>
@php
    $member=DB::table('levels')->where('l12',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>12])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>13</td>
            <td>Level 13</td>
             <td>
@php
    $member=DB::table('levels')->where('l13',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>13])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>14</td>
            <td>Level 14</td>
             <td>
@php
    $member=DB::table('levels')->where('l14',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['id'=>$id,'level'=>14])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>15</td>
            <td>Level 15</td>
             <td>
@php
    $member=DB::table('levels')->where('l15',$id)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['id'=>$id,'id'=>$id,'level'=>15])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


</table>
</div>
    </div>
    <a href="{{route('admin.user.all')}}" class="btn btn-info">Back</a>

</div>
@endsection
