@extends('front.master')

@section('content')

<div class="register_page">
  {!! Form::open(['url'=> route('client.register.submit') , 'method'=>'POST']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @include('errors')
  <div class="main-content">
    <div class="login_form text-center">
      <div class="company_info">
        <img src="{{ asset('front/images/logo1.png') }}" alt="Digi Card">
      </div>

      <h2 class="title">Register</h2>
      <div class="login_form_grid">

        {!! Form::text("name",null ,['class'=>'form__input', 'placeholder'=>'Username']) !!}

        {!! Form::email("email",null ,['class'=>'form__input', 'placeholder'=>'Email']) !!}

        <div class="select_input">
          {!! Form::select("phone_code",$operatorCode::getList() ,['class'=>'', 'placeholder'=>'', ]) !!}
          {!! Form::tel("phone",null ,['class'=>'form__input', 'placeholder'=>'Mobile No.', 'pattern'=>'[0-9]*' ]) !!}
        </div>

        {!! Form::password('password' ,['class'=>'form__input','placeholder'=>'Password']) !!}

        {!! Form::password('password_confirmation' ,['class'=>'form__input','placeholder'=>'Confirm Password']) !!}

        {!! Form::submit('Register',['class'=>'form__btn btn font-weight-bold']) !!}

        <p class="dont_have text-capitalize">do you have an account? <a href="{{ route('client.login') }}">Login Here</a></p>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>

@stop
