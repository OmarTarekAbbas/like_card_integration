@extends("front.master")

@section("content")
@if($order)
    <div class="container-fluid my-5 d-flex justify-content-center">
        <div class="card card-1">
            <div class="card-header bg-white">
                <div class="media flex-sm-row flex-column-reverse justify-content-between ">
                    <div class="col my-auto">
                        <h4 class="mb-0">Thanks for your Order,<span class="change-color">Mohamed</span> !</h4>
                    </div>
                    <div class="col-auto text-center my-auto pl-0 pt-sm-4"> <img class="img-fluid my-auto align-items-center mb-0 pt-3" src="https://i.imgur.com/7q7gIzR.png" width="115" height="115">
                        <p class="mb-4 pt-0 Glasses">Like Card</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-between mb-3">
                    <div class="col-auto">
                        <h6 class="color-1 mb-0 change-color">Receipt</h6>
                    </div>
                    <div class="col-auto "> <small>Receipt Voucher : {{ $order->orderNumber }}</small> </div>
                </div>
                @foreach($order->serials as $product)
                <div class="row mb-2">
                    <div class="col">
                        <div class="card card-2">
                            <div class="card-body">
                                <div class="media">
                                    <div class="sq align-self-center "> <img class="img-fluid my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" src="{{ $product->productImage }}" width="135" height="135" /> </div>
                                    <div class="media-body my-auto text-right">
                                        <div class="row my-auto flex-column flex-md-row">
                                            <div class="col my-auto">
                                                <h6 class="mb-0"> {{ $product->productName }}</h6>
                                            </div>
                                            <div class="col-auto my-auto"> <small> {{ $product->serialId }}</small></div>
                                            <div class="col my-auto">
                                                <h6 class="mb-0">{{ $product->validTo }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-3 ">
                                <div class="row">
                                    <div class="col-md-3 mb-3"> <small> Track Order <span><i class=" ml-2 fa fa-refresh" aria-hidden="true"></i></span></small> </div>
                                    <div class="col mt-auto">
                                        <div class="progress my-auto">
                                            <div class="progress-bar progress-bar rounded" style="width: 62%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="media row justify-content-between ">
                                            <div class="col-auto text-right"><span> <small class="text-right mr-sm-2"></small> <i class="fa fa-circle active"></i> </span></div>
                                            <div class="flex-col"> <span> <small class="text-right mr-sm-2">Out for delivary</small><i class="fa fa-circle active"></i></span></div>
                                            <div class="col-auto flex-col-auto"><small class="text-right mr-sm-2">Delivered</small><span> <i class="fa fa-circle"></i></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row mb-2">
                    <div class="col">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <p class="mb-1 text-dark"><b>Order Details</b></p>
                            </div>
                            <div class="flex-sm-col text-right col">
                                <p class="mb-1"><b>Total</b></p>
                            </div>
                            <div class="flex-sm-col col-auto">
                                <p class="mb-1">{{ $order->orderFinalTotal }} {{ $order->currencySymbol }} </p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="flex-sm-col text-right col">
                                <p class="mb-1"> <b>Payment</b></p>
                            </div>
                            <div class="flex-sm-col col-auto">
                                <p class="mb-1">{{ $order->orderPaymentMethod }}</p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="flex-sm-col text-right col">
                                <p class="mb-1"><b>Status</b></p>
                            </div>
                            <div class="flex-sm-col col-auto">
                                <p class="mb-1">{{ $order->orderCurrentStatus }}</p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="flex-sm-col text-right col">
                                <p class="mb-1"><b>Delivery Charges</b></p>
                            </div>
                            <div class="flex-sm-col col-auto">
                                <p class="mb-1">Free</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row invoice ">
                    <div class="col">
                        <p class="mb-1"> Invoice Number : {{ $order->orderNumber }}</p>
                        <p class="mb-1">Invoice Date : {{ $order->orderCreateDate }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@stop
