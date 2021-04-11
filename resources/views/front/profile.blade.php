@extends('front.master')

@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Profile</div>
					<div class="panel-body">
						@include('errors')
						@include('front.alerts')
						<form method="POST" class="form-horizontal" role="form" action="{{ route('client.profile.submit') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
									<input class="form-control" type="text" name="name" value="{{ auth()->guard('client')->user()->name }}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Email</label>
								<div class="col-md-6">
									<input class="form-control" type="email" name="email" value="{{ auth()->guard('client')->user()->email }}" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Mobile</label>
								<div class="col-md-6">
									<input class="form-control" type="text" name="phone" value="{{ auth()->guard('client')->user()->phone }}" pattern="[0-9]*" readonly>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										submit
									</button>
								</div>
							</div>
						</form>
            <hr>
						<form method="POST" class="form-horizontal" role="form" action="{{ route('client.profile.submit') }}" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="file" name="image">
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										submit
									</button>
								</div>
							</div>
						</form>
            <hr>
            <form method="POST" class="form-horizontal" role="form" action="{{ route('client.password.submit') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
								<label class="col-md-4 control-label">Old Password</label>
								<div class="col-md-6">
									<input class="form-control" type="password" name="current-password">
								</div>
							</div>
              <div class="form-group">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input class="form-control" type="password" name="password">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-6">
									<input class="form-control" type="password" name="password_confirmation">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										submit
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
