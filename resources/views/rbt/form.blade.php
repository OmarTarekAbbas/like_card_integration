@extends('template')
@section('page_title')
  Rbt Code
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Rbt Form</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @if($rbt)
                    {!! Form::model($rbt,["url"=>"rbt/$rbt->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('rbt.input',['buttonAction'=>'Edit','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"rbt","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('rbt.input',['buttonAction'=>'Save'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#rbts').addClass('active');
        $('#rbts-create').addClass('active');

        //add layer btn
        var rbt = '<div id="code" style="background-color: #f9f7f7;border-radius: 8px;box-shadow: 2px 2px 2px #e8e6e6;padding: 5px;margin:10px 0px;text-align:center">\
            <div class="col-sm-6">\
                <label class="control-label">Operator<span class="text-danger">*</span></label>\
                <div class="controls">\
                  <select class="form-control chosen-rtl"  name="operator_id[]" required>\
                    @foreach($operators as $operator)\
                    <option value="{{$operator->id}}" @if($rbt) @if($rbt->operator_id == $operator->id) selected @endif @endif>{{$operator->name}}-{{$operator->country->title}}</option>\
                    @endforeach\
                  </select>\
                </div>\
            </div>\
            <div class="col-sm-4">\
                <label class="control-label">rbt_code <span class="text-danger">*</span></label>\
                <div class="controls">\
                    {!! Form::number("rbt_code[]",null,["placeholder"=>"rbt_code","class"=>"form-control text-center","min"=>0 , "required"]) !!}\
                </div>\
            </div>\
            <div class="" style="margin-top:25px">\
              <button type="button" class="btn btn-danger delete-rbt"  name="button"> <i class="fa fa-trash" ></i> </button>\
            </div>\
          </div>';
        $(document).ready(function() {
        $(document).on("click",".add_rbt_code",function() {
            $('#rbt').append(rbt);
        });

        $(document).on("click",".delete-rbt",function() {
            $(this).parent('div').parent('div').remove();
        });
      });
    </script>
@stop
