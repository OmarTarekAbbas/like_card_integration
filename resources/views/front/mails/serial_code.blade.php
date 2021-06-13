<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Serial Code</title>
</head>

<body>

    <div class="main" style="direction:ltr">
    <img class="d-block m-auto" src="{{$message->embed(asset('front/images/logo1.png'))}}" alt="Logo" style="width: 200px;height: 224px;text-align: center;margin-left: 41%;">
    <h3>Hi From Like Card</h3>
        <div class="container">
            <main class="mainCart"
                style="clear:both; font-size:0.75rem; left:50%; margin:0 auto; overflow:hidden; padding:1rem 0; position:relative; top:50%; transform:translate(-50%, 0); width:100%"
                width="100%">

                <div class="note-box success"  style="background:#1fa67a; color:#fff; margin:1.5em 0">
                    <div class="note-icon"
                        style="background:rgba(0, 0, 0, 0.1); display:table-cell; height:100%; min-width:60px; padding:0 1em; text-align:center; vertical-align:middle"
                        height="100%" align="center" valign="middle">
                        <span style="color:#fff; font-size:60px; max-width:60px">
                            <img style="margin: auto;cursor: zoom-in;" src="https://images.vexels.com/media/users/3/155436/isolated/lists/e93670eb242ed5f2afa27aeec23b72e7-tongue-out-kawaii-emoticon.png" width="150px" height="150px">
                        </span>
                    </div>
                </div>
                <aside class="cart-aside"
                    style="-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; float:right; padding:0 1rem; position:relative; width:100%"
                    width="100%">
                    <div class="summary"
                        style="-moz-box-sizing:border-box; -webkit-box-sizing:border-box; background-color:#eee; border:1px solid #aaa; box-sizing:border-box; margin-top:1.25rem; padding:1rem; position:relative; width:100%"
                        bgcolor="#eeeeee" width="100%">
                        <div class="customer-info" style="text-align:center" align="center">user Info
                        </div>

                        <div class="customers"
                            style="border-bottom:1px solid #ccc; clear:both; margin:1rem 0; overflow:hidden; padding:0.5rem 0; text-align:left"
                            align="left">
                            <div class="customer-data" style="color:#111; float:left; text-align:left; width:30%"
                                align="right" width="30%">email</div>
                            <div class="">{{$client->email}}</div>
                        </div>

                    </div>
                </aside>
                <div class="basket"
                    style="-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; padding:0 1rem; width:100%"
                    width="100%;">
                    <table
                        style="border:solid 1px #000; padding:10px; border-collapse:collapse; caption-side:bottom;margin-top:10px;width:100%;direction:ltr">
                        <thead>
                            <tr>
                                <th style="border:solid 1px #000; padding:10px">Product Image</th>
                                <th style="border:solid 1px #000; padding:10px">Title</th>
                                <th style="border:solid 1px #000; padding:10px">Srial Code</th>
                                <th style="border:solid 1px #000; padding:10px">Valid To</th>
                                <th style="border:solid 1px #000; padding:10px">Price</th>
                                <th style="border:solid 1px #000; padding:10px">quantity</th>
                                <th style="border:solid 1px #000; padding:10px">total_price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border:solid 1px #000; padding:10px">
                                    <img src="{{$message->embed($order->product_image)}}"
                                        style="max-width:200px;max-height:200px; width:100%" width="100%"> </td>
                                <td style="border:solid 1px #000; padding:10px">
                                    {{ $order->product_name }} </td>
                                <td style="border:solid 1px #000; padding:10px">
                                {{ $order->serial_code }} </td>
                                <td style="border:solid 1px #000; padding:10px">
                                {{ $order->valid_to }} </td>
                                <td style="border:solid 1px #000; padding:10px">
                                    {{ $order->sell_price }}
                                </td>
                                <td style="border:solid 1px #000; padding:10px">
                                    {{ $order->quantity }}
                                </td>
                                <td style="border:solid 1px #000; padding:10px">
                                    {{ $order->total_price }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <aside class="cart-aside"
                    style="-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; float:right; padding:0 1rem; position:relative; width:100%"
                    width="100%">
                    <div class="summary"
                        style="-moz-box-sizing:border-box; -webkit-box-sizing:border-box; background-color:#eee; border:1px solid #aaa; box-sizing:border-box; margin-top:1.25rem; padding:1rem; position:relative; width:100%"
                        bgcolor="#eeeeee" width="100%">
                        <div class="summary-total-items" style="color:#666; font-size:0.875rem; text-align:center"
                            align="center">
                            <span class="total-items"></span>Invoice
                        </div>
                        <div class="summary-subtotal"
                            style="border-bottom:1px solid #ccc; border-top:1px solid #ccc; clear:both; margin:1rem 0; overflow:hidden; padding:0.5rem 0">
                            <div class="subtotal-title" style="color:#111; float:left; text-align:left; width:50%"
                                align="right" width="50%">Total Price</div>
                            <div class="subtotal-value final-value" id="basket-subtotal"
                                style="color:#111; float:left; text-align:left; width:50%" align="left" width="50%">
                                {{ $order->total_price }}{{ $order->currency }}</div>
                        </div>

                        <div class="summary-subtotal"
                            style="border-bottom:1px solid #ccc; border-top:1px solid #ccc; clear:both; margin:1rem 0; overflow:hidden; padding:0.5rem 0">
                            <div class="subtotal-title" style="color:#111;font-weight:bold;float:left; text-align:left; width:50%"
                                align="right" width="50%"> Invoice Number</div>
                            <div class="subtotal-value final-value" id="basket-subtotal"
                                style="color:#111; float:left; text-align:left; width:50%" align="left" width="50%">
                                {{ $order->transaction_id }}</div>
                        </div>

                        <div class="summary-subtotal"
                            style="border-bottom:1px solid #ccc; border-top:1px solid #ccc; clear:both; margin:1rem 0; overflow:hidden; padding:0.5rem 0">
                            <div class="subtotal-title" style="color:#111;font-weight:bold;float:left; text-align:left; width:50%"
                                align="right" width="50%"> Invoice Date</div>
                            <div class="subtotal-value final-value" id="basket-subtotal"
                                style="color:#111; float:left; text-align:left; width:50%" align="left" width="50%">
                                {{ $order->updated_at->format("d-m-Y") }}</div>
                        </div>

                        <div class="summary-subtotal"
                            style="border-bottom:1px solid #ccc; border-top:1px solid #ccc; clear:both; margin:1rem 0; overflow:hidden; padding:0.5rem 0">
                            <div class="subtotal-title" style="color:#111;font-weight:bold;float:left; text-align:left; width:50%"
                                align="right" width="50%"> Status</div>
                            <div class="subtotal-value final-value" id="basket-subtotal"
                                style="color:#111; float:left; text-align:left; width:50%" align="left" width="50%">
                                {{ $orderStatus::getLabel($order->status) }}</div>
                        </div>

                        <div class="summary-subtotal"
                            style="border-bottom:1px solid #ccc; border-top:1px solid #ccc; clear:both; margin:1rem 0; overflow:hidden; padding:0.5rem 0">
                            <div class="subtotal-title" style="color:#111;font-weight:bold;float:left; text-align:left; width:50%"
                                align="right" width="50%"> Payment</div>
                            <div class="subtotal-value final-value" id="basket-subtotal"
                                style="color:#111; float:left; text-align:left; width:50%" align="left" width="50%">
                                {{ $paymentType::getLabel($order->payment) }}</div>
                        </div>
                    </div>
                </aside>
            </main>
        </div>
    </div>
</body>

</html>
