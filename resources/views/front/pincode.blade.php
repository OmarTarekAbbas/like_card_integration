@extends('front.master')

@section('content')

<div class="pinCode_page">
  {!! Form::open(['url'=> route('client.profile.submit') , 'method'=>'POST' , 'enctype' => 'multipart/form-data']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @include('errors')
  @include('front.alerts')
  <div class="main-content text-center">
    <div class="logo text-center">
      <img src="{{ asset('front/images/logo1.png') }}" alt="Digi Card">
    </div>

    {!! Form::text("pincode", null,['class'=>'form__input text-center', 'placeholder'=>'Pincode']) !!}

    {!! Form::submit('Submit',['class'=>'form__btn btn font-weight-bold']) !!}

  </div>
  {!! Form::close() !!}
</div>

@stop
