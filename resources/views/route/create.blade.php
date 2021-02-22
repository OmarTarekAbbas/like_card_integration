@extends('template')

@section('page_title')
Create Route
@stop

@section('content')
@include('errors')
<div id="main-content">
  <div class="row">
    <div class="col-md-12 noPaddingPhone">
      <div class="box">
        <div class="box-title">
          <h3><i class="fa fa-bars"></i>Route</h3>
          <div class="box-tool">
            <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
            <a data-action="close" href="#"><i class="fa fa-times"></i></a>
          </div>
        </div>
        <div class="box-content">
          @if(isset($route))
          {!! Form::model($route, ['url'=>'all_routes/'.$route->id.'/update' , 'method' => 'post', 'class' => 'form-horizontal' ]) !!}

          @else
          {!! Form::open(['method' => 'POST', 'url'=>'all_routes' , 'class' => 'form-horizontal']) !!}

          @endif
          @include('route._form')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('script')
<script>
  $('#role').addClass('active');
  $('#route-index').addClass('active');
</script>
@stop
