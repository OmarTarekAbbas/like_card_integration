@extends('template')
@section('page_title')
orders
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-content">
                <div class="invoice">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>order_details</h2>
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
                            <p><i class="fa fa-phone"></i>{{$order->client->phone}}</p>
                            <p><i class="fa fa-envelope"></i> {{$order->client->email}}</p>
                        </div>
                        <div class="col-md-6 company-info">
                            <div class="alert alert-info">
                                <h4 class="text-center">Send_Mail</h4><br>
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

                    <br><br>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>main_image</th>
                                    <th>title</th>
                                    <th>messages.price</th>
                                    <th>count</th>
                                    <th>total_price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img class=" img-circle" width="100px" height="100px"
                                            src="{{ $order->product_image }}" />
                                    </td>
                                    <td>
                                       {{ $order->product_name or '----'  }}
                                    </td>
                                    <td>{{$order->sell_price}}</td>
                                    <td>{{$order->quantity}}</td>
                                    <td>{{$order->total_price}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>total_price:</strong> <span>{{$order->total_price}}</span></p>
                            <p><strong>payment:</strong> <span>{{$paymentType::getLabel($order->payment)}}</span></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- <div class="col-md-12">
      <h4 class="text-danger"> Order Replay </h4>
      <div class="table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr>
                      <th>@lang('front.auth.name')</th>
                      <th>@lang('front.auth.email')</th>
                      <th>@lang('front.admin_reply')</th>
                      <th>@lang('front.status')</th>
                      <th>  @lang('front.message') </th>
                      <th> @lang('front.date')</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($order->replaies as $key => $replay)
                  <tr>
                      <td> {{  $order->client->name }} </td>
                      <td> {{  $order->client->email }} </td>
                      <td> {{  $replay->admin->name }} </td>
                      <td>{{  $replay->status }}</td>
                      <td> {{  $replay->message }} </td>
                      <td> {{  $replay->created_at }} </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
    </div> --}}
</div>
@stop
