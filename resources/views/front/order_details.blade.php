@extends("front.master")

@section("content")
@if($order)
<section class="order_details">
  @include('front.alerts')
  <div class="card card-1">
    <div class="card-header">
      <div class="media row justify-content-between mb-3">
        <div class="col-12 text-center mt-2 p-0">
          <a href="{{ route('front.orders') }}">
            <h4 class="card-header-title mb-0">List Orders !</h4>
          </a>
        </div>

        <!-- <div class="col-6 my-auto p-0">
          <h6 class="mb-0 font-weight-bold">Thanks for your Order !</h6>
        </div>

        <div class="col-6 text-center my-auto pl-0 pt-sm-4">
          <img class="img-fluid my-auto align-items-center mb-0 pt-3 w-50" src="https://i.imgur.com/7q7gIzR.png">
          <p class="mb-4 pt-0 Glasses">Digicards</p>
        </div> -->
      </div>
    </div>

    <div class="card-body">
      <div class="row justify-content-between text-danger m-0">
        <div class="col-6 p-0">
          <h5 class="color-1 mb-0 font-weight-bold change-color">Serial Code</h5>
        </div>

        <div class="col-6 p-0">
          <h5 class="color-1 float-right mb-0 font-weight-bold change-color">
          <div class="input-group mb-3">
            <input type="text" class="form-control" style="border: none;color: red;font-weight: bolder;font-size: 14px;text-align:right" id="serial_code" value="{{ $order->serial_code }}" aria-describedby="basic-addon3">
            <div class="input-group-append">
              <span class="input-group-text" onclick="x = document.getElementById('serial_code'); x.select();document.execCommand('copy')">
                <i class="fa fa-copy"></i>
              </span>
            </div>
          </div>
          </h5>
        </div>
      </div>

      <div class="row m-0">
        <div class="col-12 p-0">
          <div class="card card-2">
            <div class="">
              <div class="card_grid">
                <div class="sq">
                  <img class="img-fluid m-auto d-block" src="{{ $order->product_image }}" />
                </div>

                <div class="media-body my-auto">
                  <div class="row my-auto flex-column flex-md-row">
                    <div class="col-12 my-auto">
                      <h6 class="mb-0">
                        <span class="font-weight-bold">Product Name :</span>
                        <small class="float-right">{{ $order->product_name }}</small>
                      </h6>
                    </div>

                    <div class="col-12 my-auto">
                      <h6 class="mb-0">
                        <span class="font-weight-bold">Valid To:</span>
                        <small class="float-right">{{ $order->valid_to }}</small>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="my-3 hr_border">
            </div>
          </div>
        </div>
      </div>

      <div class="row m-0">
        <div class="col-12 pr-1 pl-1">
          <div class="row m-0 justify-content-between">
            <div class="col-12">
              <p class="mb-1 text-center text-dark">
                <b>Order Details</b>
              </p>
            </div>

            <div class="col-12 pr-1 pl-1">
              <p class="mb-1">
                <b>Total:</b>
                <span class="float-right">{{ $order->total_price }}{{ $order->currency }}</span>
              </p>
            </div>
          </div>

          <div class="row m-0 justify-content-between">
            <div class="col-12 pr-1 pl-1">
              <p class="mb-1">
                <b>Payment:</b>
                <span class="float-right">{{ $paymentType::getLabel($order->payment) }}</span>
              </p>
            </div>
          </div>

          <div class="row m-0 justify-content-between">
            <div class="col-12 pr-1 pl-1">
              <p class="mb-1">
                <b>Status:</b>
                <span class="float-right">{{ $orderStatus::getLabel($order->status) }}</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="row m-0 invoice justify-content-between">
        <div class="col-12 pr-1 pl-1">
          <p class="mb-1">
            <b>Invoice Number:</b>
            <span class="float-right">{{ $order->transaction_id }}</span>
          </p>

          <p class="mb-1">
            <b>Invoice Date:</b>
            <span class="float-right">{{ $order->updated_at->format("d-m-Y") }}</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
@stop
