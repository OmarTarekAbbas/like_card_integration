<?php


namespace App\Services;

use App\Order;

class OrderService
{
    /**
     * handle function that make update for order
     * @param array $request
     * @return Order
     */
    public function handle($request, $order = null)
    {
        if(!$order) {
            $order = new Order;
        }


        $order->fill($request);

        $order->save();

    	return $order;
    }

}
