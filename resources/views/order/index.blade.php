@extends('template')
@section('page_title')
 orders
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">

        <div class="col-md-12">
          <div class="box box-black">
            <div class="box-title">
              <h3><i class="fa fa-table"></i> orders</h3>
              <div class="box-tool">
                <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                <a data-action="close" href="#"><i class="fa fa-times"></i></a>
              </div>
            </div>
            <div class="box-content">
              <div class="btn-toolbar pull-right">
                <div class="btn-group">
                </div>
              </div>
              <br><br>
              <div class="table-responsive">
                <table id="dtposts" class="table table-striped dt-responsive" cellspacing="0" width="100%">

                  <thead>
                  <tr>
                    <th style="width:18px"><input type="checkbox" onclick="select_all('products')"></th>
                    <th>id</th>
                    <th>client_name</th>
                    <th>total_price</th>
                    <th>order date</th>
                    <th>dcb_status</th>
                    <th>payment</th>
                    <th>order status</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@stop

@section('script')
  <script>


    $('#order').addClass('active');
    $('#order_index').addClass('active');

  </script>
  <script>
    window.onload = function () {
      $('#dtposts').DataTable({
        "processing": true,
        "serverSide": true,
        //"search": {"regex": true},
        "ajax": {
          type: "GET",
          "url": "{!! url('allorder?client_id='.request()->get('client_id')) !!}",
          "data": "{{csrf_token()}}"
        },
        columns: [
          {data: 'index', searchable: false, orderable: false},
          {data: 'id'},
          {data: 'client_name', name: 'client_name'},
          {data: 'total_price', name: 'total_price'},
          {data: 'created_at', name: 'created_at'},
          {data: 'dcb_status', name: 'dcb_status'},
          {data: 'payment', name: 'payment'},
          {data: 'status', name: 'status'},
          {data: 'action', searchable: false}
        ]
        , "pageLength": 10
      });
    };
  </script>

@stop
