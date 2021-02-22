@extends('template')
@section('content')
<!-- BEGIN Tiles -->
    @if(Auth::user()->hasRole('super_admin'))
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6">
                        <a class="tile tile-pink" data-stop="500" href="{{url('users')}}">
                            <div class="img img-center">
                                <i class="fa fa-user"></i>
                                <p class="title text-center">+{{$users}}</p>
                                <p class="title text-center">@lang('messages.users.users')</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop