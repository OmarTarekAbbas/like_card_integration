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

        $newValue = explode('-', $request['phone_code']);
        $request['phone_code']  = $newValue[0] ;
        $request['operator_id'] = $newValue[1] ;

        session()->put("quantity", $request['quantity']);

        $order->fill($request);

        $order->save();

    	  return $order;
    }

}
