@extends("front.master")

@section("content")
<!-- BEGIN Main Content -->
<div class="login_page">
  {!! Form::open(['url'=>'login']) !!}
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
          <h2 class="title">Log In</h2>

          <div class="col-12">
            {!! Form::email("email",null ,['class'=>'form__input','placeholder'=>'Email']) !!}
          </div>

          <div class="col-12">
            {!! Form::password('password' ,['class'=>'form__input','placeholder'=>'Password']) !!}<br>
          </div>

          <div class="col-12">
            <input type="checkbox" name="remember_me" id="remember_me" class="">
            <label class="form__label" for="remember_me">Remember Me!</label>
          </div>

          <div class="col-12">
            {!! Form::submit('Login',['class'=>'form__btn btn font-weight-bold']) !!}
          </div>

          <div class="col-12">
            <p class="dont_have">Don't have an account? <a href="#">Register Here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>

<!-- END Main Content -->
@stop
