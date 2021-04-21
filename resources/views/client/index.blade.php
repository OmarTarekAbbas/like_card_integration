@extends('template')
@section('page_title')
clients
@stop
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-black">
      <div class="box-title">
        <h3><i class="fa fa-table"></i> clients</h3>
        <div class="box-tool">
          <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
          <a data-action="close" href="#"><i class="fa fa-times"></i></a>
        </div>
      </div>
      <div class="box-content">
        <div class="btn-toolbar pull-right">
          <div class="btn-group">
            {{-- <i class="btn btn-circle show-tooltip" title="" href="{{url('client/create')}}" data-original-title="Add new record"><i class="fa fa-plus"></i></i> --}}
          </div>
        </div>
        <br><br>
        <div class="table-responsive">
          <table id="dtposts" class="table table-striped dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width:18px"><input type="checkbox" onclick="select_all()"></th>
                <th>image</th>
                <th>name</th>
                <th>phone</th>
                <th>email</th>
                <th>operator</th>
                <th class="visible-md visible-lg" style="width:130px">@lang('messages.action')</th>
              </tr>
            </thead>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('script')
<script>
  $('#client').addClass('active');
  $('#client-index').addClass('active');
</script>

<script>
    window.onload = function () {
      $('#dtposts').DataTable({
        "processing": true,
        "serverSide": true,
        //"search": {"regex": true},
        "ajax": {
          type: "GET",
          "url": "{!! url('allclient') !!}",
          "data": "{{csrf_token()}}"
        },
        columns: [
          {data: 'index', searchable: false, orderable: false},
          {data: 'image', name: 'image'},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data: 'phone', name: 'phone'},
          {data: 'operator', name: 'operator'},
          {data: 'action', searchable: false}
        ]
        , "pageLength": 10
      });
    };
</script>
@stop
