@extends('front.master')

@section('content')

<div class="pinCode_page">
  {!! Form::open(['url'=> route('front.pincode.verify.submit') , 'method'=>'POST' , 'enctype' => 'multipart/form-data']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @include('errors')
  @include('front.alerts')
  <div class="main-content text-center">
    <div class="logo text-center">
      <img src="{{ asset('front/images/logo1.png') }}" alt="Digicards">
      <h6 style="color: white">A verification code has been sent, please verify the mobile</h6>
    </div>

    {!! Form::text("pincode", null,['class'=>'form__input text-center', 'placeholder'=>'Pincode']) !!}

    {!! Form::submit('Submit',['class'=>'form__btn btn font-weight-bold']) !!}

  </div>
  {!! Form::close() !!}
</div>

@stop
