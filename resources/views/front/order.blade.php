@extends("front.master")

@section("content")
<section class="order_sec ">
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
      <tbody>
        @foreach($orders as $order)
        <tr class="table_grid">
          <td><span class="title">Order Number:</span> <b class="title_value">{{ $order->id }}</b></td>
          <td><span class="title">Order Final Total:</span> <b class="title_value">{{ $order->total_price }}</b></td>
          <td><span class="title">Currency Symbol:</span> <b class="title_value">{{ $order->currency }}</b></td>
          <td><span class="title">Order Create Date:</span> <b class="title_value">{{ $order->updated_at->format("D M Y") }}</b></td>
          <td><span class="title">Order Current Status:</span> <b class="title_value">{{ $orderStatus::getLabel($order->status) }}</b></td>
          <td><span class="title">Order Serial Code:</span> <b class="title_value">{{ $order->serial_code }}</b></td>
          <td class="last_grid"><a class="btn_show btn" href="{{ route('front.order.details', ['order_id' => $order->id]) }}"> Show </a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>
@stop
