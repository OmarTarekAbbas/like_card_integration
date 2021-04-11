@extends('front.master')

@section('content')

<div class="register_page">
  {!! Form::open(['url'=> route('client.register.submit') , 'method'=>'POST']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @include('errors')
  <div class="main-content">
    <div class="row m-0 text-center">
      <div class="col-12 text-center">
        <div class="company_info">
          <img src="{{ asset('front/images/logo1.png') }}" alt="Digi Card">
        </div>
      </div>

      <div class="login_form">
        <div class="col-12 ">
          <h2 class="title">Register</h2>

          <div class="col-12">
            {!! Form::text("name",null ,['class'=>'form__input', 'placeholder'=>'Username']) !!}
          </div>

          <div class="col-12">
            {!! Form::email("email",null ,['class'=>'form__input', 'placeholder'=>'Email']) !!}
          </div>

          <div class="col-12">
            {!! Form::tel("phone",null ,['class'=>'form__input', 'placeholder'=>'Mobile No.', 'pattern'=>'[0-9]*' ]) !!}
          </div>

          <div class="col-12">
            {!! Form::password('password' ,['class'=>'form__input','placeholder'=>'Password']) !!}<br>
          </div>

          <div class="col-12">
            {!! Form::password('password_confirmation' ,['class'=>'form__input','placeholder'=>'Confirm Password']) !!}<br>
          </div>

          <div class="col-12">
            {!! Form::submit('Register',['class'=>'form__btn btn font-weight-bold']) !!}
          </div>

          <div class="col-12">
            <p class="dont_have text-capitalize">do you have an account? <a href="{{ route('client.login') }}">Login Here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>

@stop
