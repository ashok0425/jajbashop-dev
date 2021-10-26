@extends('email.layout')
@section('content')


<tr class="information">
    <td colspan="4">
       <h5>Hello <h2>{{$name}}</h2>,Thank you for your registration to Jajbashop.
    </h5>

       <p>Your username is {{$username}} and password is {{$password}}</p>
    </td>
</tr>
@endsection
