@extends('layout.header')
@section('content')
    <div class="main-block">
        <div class="main-container register-form">
            <div class="sub-block">
                <h2 class="text-center">Register</h2>
                <div class="border-dashed"></div>
                <form id="register-form" class="row" method="POST" action="{{route('do_register')}}">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">First name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name" value="{{old('first_name')}}">
                            @if($errors->has('first_name'))
                                <p class="help-block has-error">{{$errors->first('first_name')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="{{old('last_name')}}">
                        @if($errors->has('last_name'))
                            <p class="help-block has-error">{{$errors->first('last_name')}}</p>
                        @endif
                    </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" value="{{old('email')}}">
                            @if($errors->has('email'))
                                <p class="help-block has-error">{{$errors->first('email')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                            @if($errors->has('password'))
                                <p class="help-block has-error">{{$errors->first('password')}}</p>
                            @endif
                        </div>
                        <button id="register" type="button" class="btn btn-primary btn-block">Register</button>
                        <div>
                            <p class="register-link">Already register? <a href="{{route('login')}}">Login</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#register').click(function(){
            $('#register').html('Please wait ...');
            $('#register').attr('disabled', 'disabled');
            $('#register-form').submit();
        });
    </script>
@endsection