@extends('template')
@section('page_title')
    @lang('messages.users.users')
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.users.edit_user')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" action="{{url('users/'.$user->id.'/update')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.user_name') *</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                {{-- {!! Form::text('category_name',null,['placeholder'=>'Category Name','class'=>'form-control input-lg']) !!} --}}
                                <input type="text" name="name" placeholder="@lang('messages.users.user_name')" value="{{$user->name}}" class="form-control input-lg" required>
                                <span class="help-inline">@lang('messages.users.add_user')</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.email') *</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                {{-- {!! Form::text('category_name',null,['placeholder'=>'Category Name','class'=>'form-control input-lg']) !!} --}}
                                <input type="email" name="email" placeholder="Email" value="{{$user->email}}" class="form-control input-lg" required>
                                {{-- <span class="help-inline">Enter a new Email</span> --}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.password') {{-- (optional) --}}</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                {{-- {!! Form::text('category_name',null,['placeholder'=>'Category Name','class'=>'form-control input-lg']) !!} --}}
                                <input type="password" name="password" placeholder="@lang('messages.users.password')" class="form-control input-lg" >
                                {{-- <span class="help-inline">Enter a new Password</span> --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.phone') (optional)</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <input type="text" name="phone" placeholder="@lang('messages.users.phone')" value="{{$user->phone}}" class="form-control input-lg" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.users.role') *</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <select class="form-control chosen-rtl" data-placeholder="Choose a Role" name="role" tabindex="1">
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}" @if($user->roles()->first()->name==$role->name) selected="selected" @endif>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                <input type="submit" class="btn btn-primary" value="@lang('messages.save')">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop

@section('script')
    <script>
        $('#user').addClass('active');
        $('#user-index').addClass('active');
    </script>
@stop