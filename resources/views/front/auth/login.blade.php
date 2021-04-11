@extends("front.master")

@section("content")
<!-- BEGIN Main Content -->
<div class="login-wrapper">

    <!-- BEGIN Login Form -->
        {!! Form::open(['url'=>'login']) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h3>Login to your account</h3>
            @include('errors')
            <hr/>
            <div class="form-group">
                <div class="controls">
                    {!! Form::email("email",null ,['class'=>'form-control','placeholder'=>'Email']) !!}<br>
                </div>
            </div>
            <div class="form-group">
                <div class="controls">
                    {!! Form::password('password' ,['class'=>'form-control','placeholder'=>'password']) !!}<br>
                </div>
            </div>

            <div class="form-group">
                <div class="controls">
                    {!! Form::submit('Login',['class'=>'btn btn-primary form-control']) !!}
                </div>
            </div>
            <hr/>
            <p class="clearfix">
                <!-- <a href="{{ url('password/reset') }}" class="goto-forgot pull-left">Forgot Password?</a> -->
                <!--a href="#" class="goto-register pull-right">Sign up now</a-->
            </p>
        {!! Form::close() !!}
    <!-- END Login Form -->

</div>
<!-- END Main Content -->
@stop
