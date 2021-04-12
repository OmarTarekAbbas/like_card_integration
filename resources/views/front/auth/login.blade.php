@extends("front.master")

@section("content")

<div class="login_page">
  {!! Form::open(['url'=>route('client.login.submit') ]) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @include('errors')
  <div class="main-content">
    <div class="login_form text-center">
      <div class="company_info">
        <img src="{{ asset('front/images/logo1.png') }}" alt="Digi Card">
      </div>

      <div class="login_form_grid">
        <h2 class="title">Log In</h2>

        <div class="login_form_grid">
          {!! Form::email("email",null ,['class'=>'form__input','placeholder'=>'Email']) !!}

          {!! Form::password('password' ,['class'=>'form__input','placeholder'=>'Password']) !!}

          <label class="form__label" for="remember_me">
            <input type="checkbox" name="remember_me" id="remember_me" class="">
            Remember Me!
          </label>

          {!! Form::submit('Login',['class'=>'form__btn btn font-weight-bold']) !!}

          <p class="dont_have text-capitalize">Don't have an account? <a href="{{ route('client.register') }}">Register Here</a></p>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>

@stop
