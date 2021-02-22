@extends('template')
@section('page_title')
	@lang('messages.users.users')
@stop
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-black">
				<div class="box-title">
					<h3><i class="fa fa-table"></i> @lang('messages.users.users')</h3>
					<div class="box-tool">
						<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
						<a data-action="close" href="#"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="box-content">
					<div class="btn-toolbar pull-right">
						<div class="btn-group">
							<a class="btn btn-circle show-tooltip" title="" href="{{url('users/new')}}" data-original-title="Add new record"><i class="fa fa-plus"></i></a>
							<?php
								$table_name = "users" ;
							?>
							@include('partial.delete_all')
						</div>
					</div>
					<br><br>
					<div class="table-responsive">
						<table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
							<thead>
							<tr>
								<th style="width:18px"><input type="checkbox" onclick="select_all()"></th>
								<th>@lang('messages.users.user_name')</th>
								<th>@lang('messages.users.email')</th>
								<th>@lang('messages.users.role')</th>
								<th>@lang('messages.users.phone')</th>
								<th class="visible-md visible-lg" style="width:130px">@lang('messages.action')</th>
							</tr>
							</thead>
							<tbody>
							@foreach($users as $user)
								@if($user->email!=\Auth::user()->email)
									<tr class="table-flag-blue">
										<th><input type="checkbox" name="selected_rows[]" class="users" value="{{$user->id}}" onclick="collect_selected(this)"></th>
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->role}}</td>
										<td>{{$user->phone}}</td>
										<td class="visible-md visible-lg">
											<div class="btn-group">
                                                @if (get_action_icons('users/{id}/edit', 'get'))
												<a class="btn btn-sm show-tooltip" title="" href="{{url('users/'.$user->id.'/edit')}}" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if (get_action_icons('users/{id}/edit', 'get'))
												<a class="btn btn-sm btn-danger show-tooltip" title="" onclick="return confirm('Are you sure you want to delete this ?');" href="{{url('users/'.$user->id.'/delete')}}" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                @endif
											</div>
										</td>
									</tr>
								@endif
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('script')
	<script>
	var check = false ;
		function select_all()
		{
			if(!check)
			{
				$('.users').prop("checked",!check);
				<?php
				foreach($users as $user)
				{
					if($user->email!=\Auth::user()->email){
				?>
						collect_selected("{{$user->id}}") ;
				<?php
						}
					}
				?>
				check = true ;
			}
			else
			{
				$('.users').prop("checked",!check);
				check = false ;
				clear_selected() ;
			}
		}
	</script>
	<script>
		$('#user').addClass('active');
		$('#user-index').addClass('active');
	</script>
@stop
