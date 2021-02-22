@extends('template')
@section('page_title')
	Content Type
@stop
@section('content')
	@include('errors')
<!-- BEGIN Content -->
<div id="main-content">
	<div class="row">
	    <div class="col-md-12">
	        <div class="box box-black">
	            <div class="box-title">
	                <h3><i class="fa fa-table"></i> Content Type Table</h3>
	                <div class="box-tool">
	                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
	                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
	                </div>
	            </div>
	            <div class="box-content">
					<div class="btn-toolbar pull-right">
						<div class="btn-group">
							<a class="btn btn-circle show-tooltip" title="Add new Content Type" href="{{url('content_type/create')}}" data-original-title="Add new Content Type"><i class="fa fa-plus"></i></a>
							<?php
								$table_name = "content_types" ;
								// pass table name to delete all function
								// if the current route exists in delete all table flags it will appear in view
								// else it'll not appear
							?>
							@include('partial.delete_all')
						</div>
					</div>
					<br><br>
					<div class="table-responsive">
						<table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:18px"><input type="checkbox" onclick="select_all('settings')"></th>
								<th>Title</th>
								<th class="visible-md visible-lg" style="width:130px">Action</th>
							</tr>
						</thead>
						<tbody id="tablecontents">
						@foreach($content_types as $type)
							<tr class="table-flag-blue">
								<td><input class="select_all_template" type="checkbox" name="selected_rows[]" value="{{$type->id}}" onclick="collect_selected(this)"></td>
								<td>{{$type->title}}</td>
								<td class="visible-md visible-lg">
								    <div class="btn-group">
											<!-- <a class="btn btn-sm btn-success show-tooltip" title="Add Content" href="{{url("content/create?type_id=".$type->id."&title=".$type->title)}}" data-original-title="Add Content"><i class="fa fa-plus"></i></a> -->
								    	<a class="btn btn-sm show-tooltip" title="" href="{{url('content_type/'.$type->id.'/edit')}}" data-original-title="Edit"><i class="fa fa-edit"></i></a>
								      <a class="btn btn-sm btn-danger show-tooltip" title="" onclick = 'return ConfirmDelete()' href="{{url('content_type/'.$type->id.'/delete')}}" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
								    </div>
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
	            </div>
	        </div>
	    </div>
	</div>
</div>

@stop
@section('script')
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">

    $(function () {
    	$("#example").DataTable();

    });

    </script>
	<script>
	$('#content_types').addClass('active');
	$('#content_types_index').addClass('active');
	</script>
@stop
