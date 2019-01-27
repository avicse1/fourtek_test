@extends('layout.header')
@section('content')
    <div class="main-block">
        <div class="main-container login-form">
            <div class="sub-block">
                <h2 class="text-center">Login</h2>
                <div class="border-dashed"></div>
                <form id="login-form" method="POST" action="{{route('do_login')}}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
                    <button id="login" type="button" class="btn btn-primary btn-block">Login</button>
                    <div>
                        <p class="register-link">Don't have account? <a href="{{route('register')}}">Register</a></p>
                        <p class="register-link forgot-link"><a href="#">Forgot password?</a></p>
                    </div>
                </form>
            </div>            
        </div>
    </div>
    <script>
        $('#login').click(function(){
            $('#login').html('Please wait ...');
            $('#login').attr('disabled', 'disabled');
            $('#login-form').submit();
        });
    </script>
@endsection