@extends('template')
@section('page_title')
  Content Type
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Content Type</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @if($content_type)
                    {!! Form::model($content_type,["url"=>"content_type/$content_type->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('content_type.input',['buttonAction'=>'Edit','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"content_type","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('content_type.input',['buttonAction'=>'Save','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>

        $('#content_types').addClass('active');
        $('#content_types_create').addClass('active');

    </script>
@stop
