@extends('template')
@section('page_title')
  Sub Category
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Sub Category Form</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @if($category)
                    {!! Form::model($category,["url"=>"sub_category/$category->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('sub_category.input',['buttonAction'=>'Edit','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"sub_category","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('sub_category.input',['buttonAction'=>'Save','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>

        $('#sub_category').addClass('active');
        $('#sub_category_create').addClass('active');

    </script>
@stop
