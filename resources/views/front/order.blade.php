@extends("front.master")

@section("content")
<div class="container">
  <h2>List Order</h2>
  <p>List All Previous Order With Status:</p>
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
      <tr>
        <td>{{  $order->orderNumber }}</td>
        <td>{{  $order->orderFinalTotal }}</td>
        <td>{{  $order->currencySymbol }}</td>
        <td>{{  $order->orderCreateDate }}</td>
        <td>{{  $order->orderCurrentStatus }}</td>
        <td>{{  $order->orderPaymentMethod }}</td>
        <td> <a class="btn btn-gray text-success" href="{{ route('front.order.details', ['order_id' => $order->orderNumber]) }}"> Show </a> </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  </div>
</div>
@stop
