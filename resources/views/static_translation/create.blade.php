@extends('template')

@section('page_title')
    Create Static Value
@stop

@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Add Static Key Word</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                     @if(isset($static_translation))
                        {!! Form::model($static_translation, ['route' => ['static_translation.update', $static_translation->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files'=>'true' ]) !!}

                    @else
                        {!! Form::open(['method' => 'POST', 'route' => 'static_translation.store', 'class' => 'form-horizontal', 'files'=>'true' ]) !!}
                        
                           
                    @endif
                        @include('static_translation._form')
                        {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop

@section('script')
    <script>
        $('#static').addClass('active');
        $('#static-create').addClass('active');
    </script>
@stop