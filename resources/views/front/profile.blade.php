@extends('front.master')

@section('content')

<div class="profile_page">
  {!! Form::open(['url'=> route('client.profile.submit') , 'method'=>'POST']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @include('errors')
  @include('front.alerts')
  <div class="main-content">
    <div class="row m-0 w-100 text-center">
      <div class="login_form">
        <div class="col-12 ">
          <h2 class="title">Profile</h2>
        </div>

        <div class="col-12">
          <div class="upload_img">
            <a onclick="_upload()">

              <img id='output' class="img-fluid rounded-circle" src="{{ asset('front/images/logo1.png') }}" alt="Profile Picture">

              <i id="icon_upload" class="upload_icon_img fas fa-camera fa-3x"></i>
            </a>
          </div>

          <input type="file" name="image" accept='image/*' id="file_upload_id" onchange="openFile(event)" style="display:none">
        </div>

        <div class="col-12">
          {!! Form::text("name", auth()->guard('client')->user()->name ,['class'=>'form__input', 'placeholder'=>'Username']) !!}
        </div>

        <div class="col-12">
          {!! Form::email("email", auth()->guard('client')->user()->email ,['class'=>'form__input', 'placeholder'=>'Email', 'readonly']) !!}
        </div>

        <div class="col-12">
          {!! Form::tel("phone", auth()->guard('client')->user()->phone ,['class'=>'form__input', 'placeholder'=>'Mobile No.', 'pattern'=>'[0-9]*', 'readonly']) !!}
        </div>

        <div class="col-12">
          {!! Form::submit('Submit',['class'=>'form__btn btn font-weight-bold']) !!}
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

  {!! Form::open(['url'=> route('client.profile.submit') , 'method'=>'POST' , 'role'=>'form', 'enctype'=>'multipart/form-data' ]) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="main-content">
    <div class="login_form">
      <div class="row m-0 text-center">
        <div class="col-12">
          {!! Form::password('password' ,['class'=>'form__input','placeholder'=>'Password']) !!}<br>
        </div>

        <div class="col-12">
          {!! Form::password('old_password' ,['class'=>'form__input','placeholder'=>'Old Password']) !!}<br>
        </div>

        <div class="col-12">
          {!! Form::password('password_confirmation' ,['class'=>'form__input','placeholder'=>'Confirm Password']) !!}<br>
        </div>

        <div class="col-12">
          {!! Form::submit('Submit',['class'=>'form__btn btn font-weight-bold']) !!}
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>

@stop
