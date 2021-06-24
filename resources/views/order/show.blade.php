@extends('template')
@section('page_title')
orders
@stop
@section('content')
<style>
.item .mt-100 {
    margin-top: 150px
}

.item .modal-content {
    border-radius: 0.7rem
}

@media(width:1024px) {
    .item .modal-dialog {
        max-width: 700px
    }
}

.item .modal-title {
    text-align: center;
    font-size: 3vh;
    font-weight: bold
}

.item h4 {
    margin-left: auto
}

.item .modal-header {
    border-bottom: none;
    text-align: center;
    padding-bottom: 0
}

.item h6 {
    color: rgb(2, 55, 230);
    margin-top: 2vh;
    margin-bottom: 0;
    font-size: 2vh
}

.item .modal-body {
    padding: 2vh
}

.item .modal-footer {
    border-top: none;
    justify-content: center;
    padding-top: 0
}

.item .row {
    border-bottom: 1px solid rgba(0, 0, 0, .2);
    padding: 2vh 0 2vh 0;
    justify-content: space-between;
    flex-wrap: unset;
    margin: 0
}

.item ul {
    padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around
}

.item ul li {
    font-size: 2vh;
    font-weight: bold;
    line-height: 4vh
}

.item .left {
    float: left;
    font-weight: normal;
    color: rgb(126, 123, 123)
}

.item .right {
    float: right;
    text-align: right
}

.item .col {
    padding-left: 0
}

@media(min-width:1025px) {
  .item img {
        width: 10%
    }
}

.item .btn {
    background-color: rgb(2, 55, 230);
    border-color: rgb(2, 55, 230);
    color: white;
    width: 90%;
    padding: 2vh;
    margin-top: 0;
    border-radius: 0.7rem;
    box-shadow: none
}

.item .openmodal {
    background-color: white;
    color: black;
    width: 30vw
}

:-moz-any-link:focus {
    outline: none
}

.item button:active {
    outline: none
}

.item button:focus {
    outline: none
}

.item .btn:focus {
    box-shadow: none
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-content">
                <div class="invoice">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Order Details</h2>
                        </div>

                        <div class="col-md-6 invoice-info">
                            <p class="font-size-17"><strong>order_number</strong> #{{$order->id}}</p>
                            <p>{{$order->created_at->format('d M Y')}}</p>
                            <p style="font-weight: bold;">{{$orderStatus::getLabel($order->status)}}</p>
                        </div>
                    </div>

                    <hr class="margin-0">

                    <div class="row">
                        <div class="col-md-6 company-info">
                            <h4>{{$order->client->name}}</h4>
                            <p><i class="fa fa-phone"></i>{{$order->phone}}</p>
                            <p><i class="fa fa-envelope"></i> {{$order->client->email}}</p>
                        </div>
                        <div class="col-md-6 company-info">
                            <div class="alert alert-info">
                                <h4 class="text-center">Send Mail</h4><br>
                                <div class="row text-center">
                                    <form action="{{url('order/send_message')}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <input type="hidden" name="client_id" value="{{$order->client_id}}">
                                        <div class="col-md-12">
                                            <textarea type="text" name="message"
                                                style="width:100%"
                                                cols="70" rows="9" class="form-control" required
                                                placeholder="Your Message"></textarea>
                                            <br>
                                        <button type="submit" class="btn btn-primary btn-lg">send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="item d-flex">
        <div class="">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{ $order->product_name }}</h4>
            </div> <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col"> <img class="img-fluid img-responsive" src="{{ $order->product_image }}"> </div>
                        <div class="col-xs-6" style="padding-top: 2vh;">
                            <ul type="none">
                                <li>Serial Code: {{ $order->serial_code }}</li>
                                <li>Hash Serial Code: {{ $order->hash_serial_code }}</li>
                                <li>Valid To   : {{ $order->valid_to }}</li>
                            </ul>
                        </div>
                    </div>
                    <h6>Order Details</h6>
                    <div class="row">
                        <div class="col-xs-6">
                            <ul type="none">
                                <li class="left">Order number:</li>
                                <li class="left">Digicards Price:</li>
                                <li class="left">Date:</li>
                                <li class="left">Sell Price:</li>
                                <li class="left">quantity:</li>
                                <li class="left">Total Price:</li>
                            </ul>
                        </div>
                        <div class="col-xs-6">
                            <ul class="right" type="none">
                                <li class="right">{{ $order->transaction_id }}</li>
                                <li class="right">{{ $order->original_price }}</li>
                                <li class="right">{{ $order->updated_at->format('d-m-Y') }}</li>
                                <li class="right">{{ $order->sell_price }}</li>
                                <li class="right">{{ $order->quantity }}</li>
                                <li class="right">{{ $order->total_price }}</li>
                            </ul>
                        </div>
                    </div>
                    <h6>Payment Details</h6>
                    <div class="row" style="border-bottom: none">
                        <div class="col-xs-6">
                            <ul type="none">
                                <li class="left">Payment</li>
                                <li class="left">status</li>
                            </ul>
                        </div>
                        <div class="col-xs-6">
                            <ul type="none">
                                <li class="right">{{$paymentType::getLabel($order->payment)}}</li>
                                <li class="right">{{$orderStatus::getLabel($order->status)}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- Modal footer -->
        </div>
    </div>

    <div class="col-md-12">
      <h4 class="text-danger"> Order Replay </h4>
      <div class="table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr>
                      <th>name</th>
                      <th>email</th>
                      <th>admin</th>
                      <th>message</th>
                      <th>date</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($order->replaies as $key => $replay)
                  <tr>
                      <td> {{  $order->client->name }} </td>
                      <td> {{  $order->client->email }} </td>
                      <td> {{  $replay->admin->name }} </td>
                      <td> {{  $replay->message }} </td>
                      <td> {{  $replay->created_at->format('d-m-Y') }} </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
    </div>
</div>
@stop
