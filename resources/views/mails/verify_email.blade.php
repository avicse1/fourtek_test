@extends('layout.header')
@section('content')
<div class="container">
    <div class="body">
        <h3 class="name">Dear {{$name}},</h3>
        <p>Thanks for creating an account with the Fourtek.</p>
        <p>Please click on the below activate link to verify your email address.</p>
        <a href="{{asset('/').'verify-email?email='.urlencode($email).'&code='.urlencode($confirmation_code)}}">
            Click here
        </a>
    </div>
</div>
@endsection