<?php


namespace App\Services;

use App\Order;

class OrderService
{
    /**
     * handle function that make update for order
     * @param array $request
     * @param \App\Order|null $order
     * @return Order
     */
    public function handle($request, $order = null)
    {
        if(!$order) {
            $order = new Order;
        }

        $request['client_id'] = auth()->guard("client")->user()->id;

        if(isset($request['price']) && isset($request['quantity'])) {
          $request['total_price'] = $request['price'] * $request['quantity'];
          session()->put("total_price", $request['total_price']);
        }

        $order->fill($request);

        $order->save();

    	  return $order;
    }

}
