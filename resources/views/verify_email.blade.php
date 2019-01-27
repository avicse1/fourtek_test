@extends('layout.header')
@section('content')
<h1 class="text-center">You account is verified successfully!</h1>
<p class="text-center">Please click the below link to login</p>
<h3 class="text-center"><a href="{{route('login')}}">Click here</a></h3>
@endsection

