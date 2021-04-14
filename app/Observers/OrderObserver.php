<?php

namespace App\Observers;

use App\Order;
use App\OrderItem;

class OrderObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Order  $post
     * @return void
     */
    public function saved(Order $order)
    {
      $productImage = session()->get('productImage');
      $productPrice = session()->get('productPrice');
      $productName = session()->get('productName');
      $serial_id   = session()->has('serial_id') ? session("serial_id") : null;
      $serial_code = session()->has('serial_code') ? session("serial_code") : null;
      $valid_to    = session()->has('valid_to') ? session("valid_to") : null;

      OrderItem::updateOrcreate(['order_id' => $order->id],[
        'order_id'      => $order->id,
        'product_name'  => $productName,
        'product_image' => $productImage,
        'currency'      => $order->currency,
        'quantity'      => (int)($order->total_price / $productPrice),
        'serial_id'     => $serial_id,
        'valid_to'      => $valid_to,
        'serial_code'   => $serial_code,
        'price'         => $productPrice,
        'total_price'   => $order->total_price
      ]);
    }

}
