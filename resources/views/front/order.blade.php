@extends("front.master")

@section("content")
<section class="order_sec">
  <div class="row m-0">
    <div class="col-12">
      <h2 class="text-center">List Order</h2>
      <p class="text-center">List All Previous Order With Status:</p>
      @if(session()->has("success"))
      <p class="text-success"> {{ session()->get("success") }} </p>
      @endif
      @if(session()->has("faild"))
      <p class="text-danger"> {{ session()->get("faild") }} </p>
      @endif
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>orderNumber</th>
              <th>orderFinalTotal</th>
              <th>currencySymbol</th>
              <th>orderCreateDate</th>
              <th>orderCurrentStatus</th>
              <th>orderPaymentMethod</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach($orders as $order)
            <tr class="table_grid">
              <td><span class="title">Order Number:</span> <b class="title_value">{{ $order->orderNumber }}</b></td>
              <td><span class="title">Order Final Total:</span> <b class="title_value">{{ $order->orderFinalTotal }}</b></td>
              <td><span class="title">Currency Symbol:</span> <b class="title_value">{{ $order->currencySymbol }}</b></td>
              <td><span class="title">Order Create Date:</span> <b class="title_value">{{ $order->orderCreateDate }}</b></td>
              <td><span class="title">Order Current Status:</span> <b class="title_value">{{ $order->orderCurrentStatus }}</b></td>
              <td><span class="title">Order Payment Method:</span> <b class="title_value">{{ $order->orderPaymentMethod }}</b></td>
              <a class="btn_show btn" href="{{ route('front.order.details', ['order_id' => $order->orderNumber]) }}"> Show </a>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@stop
