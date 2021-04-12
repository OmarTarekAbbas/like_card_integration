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

      OrderItem::updateOrcreate(['order_id' => $order->id],[
        'order_id' => $order->id,
        'product_name' => $productName,
        'product_image' => $productImage,
        'currency' => $order->currency,
        'quantity' => (int)($order->total_price / $productPrice),
        'price' => $productPrice,
        'total_price' => $order->total_price
      ]);
    }

}
