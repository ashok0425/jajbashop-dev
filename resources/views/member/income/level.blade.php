@extends('member.master')

@php
       define('PAGE','account')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Level wise Member Count</h3>

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
    $member=DB::table('levels')->where('l1',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>1])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>
        <tr>
            <td>2</td>
            <td>Level 2</td>
             <td>
@php
    $member=DB::table('levels')->where('l2',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>2])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>3</td>
            <td>Level 3</td>
             <td>
@php
    $member=DB::table('levels')->where('l3',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>3])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>4</td>
            <td>Level 4</td>
             <td>
@php
    $member=DB::table('levels')->where('l4',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>4])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>5</td>
            <td>Level 5</td>
             <td>
@php
    $member=DB::table('levels')->where('l5',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>5])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>6</td>
            <td>Level 6</td>
             <td>
@php
    $member=DB::table('levels')->where('l6',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>6])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>7</td>
            <td>Level 7</td>
             <td>
@php
    $member=DB::table('levels')->where('l7',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>7])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>8</td>
            <td>Level 8</td>
             <td>
@php
    $member=DB::table('levels')->where('l8',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>8])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>9</td>
            <td>Level 9</td>
             <td>
@php
    $member=DB::table('levels')->where('l9',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>9])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>10</td>
            <td>Level 10</td>
             <td>
@php
    $member=DB::table('levels')->where('l10',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>10])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>11</td>
            <td>Level 11</td>
             <td>
@php
    $member=DB::table('levels')->where('l11',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>11])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>12</td>
            <td>Level 12</td>
             <td>
@php
    $member=DB::table('levels')->where('l12',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>12])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>13</td>
            <td>Level 13</td>
             <td>
@php
    $member=DB::table('levels')->where('l13',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>13])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>14</td>
            <td>Level 14</td>
             <td>
@php
    $member=DB::table('levels')->where('l14',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>14])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>

        <tr>
            <td>15</td>
            <td>Level 15</td>
             <td>
@php
    $member=DB::table('levels')->where('l15',Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.member.level.show',['level'=>15])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>


</table>
</div>
    </div>

</div>
@endsection
