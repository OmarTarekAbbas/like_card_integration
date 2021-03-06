@extends('front.master')

@section('content')

<div class="profile_page">
  {!! Form::open(['url'=> route('client.profile.submit') , 'method'=>'POST' , 'enctype' => 'multipart/form-data']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @include('errors')
  @include('front.alerts')
  <div class="main-content">
    <div class="login_form text-center">
      <h2 class="title">Profile</h2>

      <div class="login_form_grid ">
        <div class="upload_img">
          <a onclick="_upload()">
            <img id='output' class="img-fluid rounded-circle" src="{{ url(auth()->guard('client')->user()->image?? 'front/images/logo1.png') }}" alt="Profile Picture">

            <i id="icon_upload" class="upload_icon_img fas fa-camera fa-3x"></i>
          </a>
        </div>

        <input type="file" name="image" accept='image/*' id="file_upload_id" onchange="openFile(event)" style="display:none">


        <div class="login_form_grid_child">

          {!! Form::email("email", auth()->guard('client')->user()->email ,['class'=>'form__input', 'style'=>'cursor: no-drop;', 'placeholder'=>'Email', 'readonly' ]) !!}
          
          {{--
          {!! Form::text("name", auth()->guard('client')->user()->name ,['class'=>'form__input', 'placeholder'=>'Username']) !!}

          <div class="select_input">
          {!! Form::select("operator_id", getCountryOperators(), auth()->guard('client')->user()->operator->code.'-'.auth()->guard('client')->user()->operator->id ,['disabled']) !!}
          {!! Form::tel("phone",auth()->guard('client')->user()->phone ,['class'=>'form__input', 'style'=>'cursor: no-drop;', 'placeholder'=>'Mobile No.', 'pattern'=>'[0-9]*', 'readonly', 'disabled' ]) !!}
          </div>
          --}}

          {!! Form::submit('Submit',['class'=>'form__btn btn font-weight-bold']) !!}
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

  {{--
    {!! Form::open(['url'=> route('client.password.submit') , 'method'=>'POST' , 'role'=>'form', 'enctype'=>'multipart/form-data' ]) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="main-content">
      <div class="login_form text-center">
        <div class="login_form_grid gridV2">
          {!! Form::password('current-password' ,['class'=>'form__input','placeholder'=>'Old Password']) !!}

          {!! Form::password('password' ,['class'=>'form__input','placeholder'=>'Password']) !!}

          {!! Form::password('password_confirmation' ,['class'=>'form__input','placeholder'=>'Confirm Password']) !!}

          {!! Form::submit('Submit',['class'=>'form__btn btn font-weight-bold']) !!}
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  --}}
</div>

@stop
