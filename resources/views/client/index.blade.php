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
          <table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width:18px"><input type="checkbox" onclick="select_all()"></th>
                <th>image</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>operator</th>
                <th class="visible-md visible-lg" style="width:130px">@lang('messages.action')</th>
              </tr>
            </thead>
            <tbody>
              @foreach($clients as $client)
              <tr class="table-flag-blue">
                <th><input type="checkbox" name="selected_rows[]" class="clients" value="{{$client->id}}" onclick="collect_selected(this)"></th>
                <td> <img src="{{$client->image}}" alt="" width="100px" height="100px" style="border-radius:10px"> </td>
                <td>{{$client->name??'no name'}}</td>
                <td>{{$client->email}}</td>
                <td>{{$client->phone}}</td>
                <td>{{$client->operator->name}}</td>
                <td class="visible-md visible-lg">
                  <div class="btn-group">
                    <a class="btn btn-sm btn-warning show-tooltip" title="Show Order" href="{{url("order?client_id=$client->id")}}" data-original-title="show Order"><i class="fa fa-step-forward"></i></a>
                    <a class="btn btn-sm btn-danger show-tooltip" title="" onclick="return confirm('Are you sure you want to delete this ?');" href="{{url('client/'.$client->id.'/delete')}}" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
@stop

@section('script')
<script>
  $('#client').addClass('active');
  $('#client-index').addClass('active');
</script>
@stop
