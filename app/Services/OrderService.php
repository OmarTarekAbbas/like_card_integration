<?php


namespace App\Services;

use App\Order;

class OrderService
{

    /**
     * @var LikeCardService
     */
    private $likeCardService;

    /**
     * __construct
     * @param LikeCardService $likeCardService
     * @return void
     */
    public function __construct(LikeCardService $likeCardService)
    {
        $this->likeCardService = $likeCardService;
    }
    /**
     * handle function that make create or update for order
     *
     * @param array $request [pincode_request_id, dcb_status, qty, currency, sell_price, phone, phone_code, operator_id]
     * @param \App\Order|null $order
     * @return Order
     */
    public function handle($request, $order = null)
    {
        if(!$order) {
            $order = new Order;
        }

        $request['client_id'] = auth()->guard("client")->user()->id;

        if(isset($request['sell_price']) && isset($request['quantity'])) {
          $request['total_price'] = $request['sell_price'] * $request['quantity'];
          session()->put("total_price", $request['total_price']);
        }

        $request['product_name']     = session()->get('productName');
        $request['product_image']    = session()->get('productImage');
        $request['original_price']   = session()->get('originalPrice');
        $request['serial_id']        = session()->has('serial_id') ? session("serial_id") : null;
        $request['hash_serial_code'] = session()->has('serial_code') ? session("serial_code") : null;
        $request['serial_code']      = session()->has('serial_code') ? $this->likeCardService->decryptSerial(session("serial_code")) : null;
        $request['valid_to']         = session()->has('valid_to') ? session("valid_to") : null;

        $newValue = explode('-', $request['phone_code']);
        $request['phone_code']  = $newValue[0] ;
        $request['operator_id'] = $newValue[1] ;

        $order->fill($request);

        $order->save();

    	  return $order;
    }

}
