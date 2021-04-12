<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\LikeCardService;
use App\Services\PaymentInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * likeCard
     *
     * @var \App\Services\LikeCardService
     */
    private $likeCard;

    /**
     * Payment
     *
     * @var \App\Services\PaymentInterface
     */
    private $payment;

    /**
     * Method __construct
     *
     * @param \App\Services\LikeCardService $likeCard
     */
    public function __construct(LikeCardService $likeCard, PaymentInterface $payment)
    {
        $this->likeCard = $likeCard;
        $this->payment  = $payment ;
    }
    /**
     * Method createOrder
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createOrder(Request $request)
    {
      $this->payment->buyItems($request->all());
      if($this->payment->isSuccess()){
        $response = $this->payment->getData();
        return redirect()->route("front.order.details",["id" => $response->orderId]);
      }
      session()->flash("faild", $this->payment->getError());
      return back();
    }

    /**
     * Method ListOrders
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ListOrders()
    {
        try {
            $response = json_decode($this->likeCard->Orders());
            $orders = $response->data ;
        } catch (\Throwable $th) {
            $orders = [] ;
        }

        return view("front.order", compact("orders"));
    }

    /**
     * Method ListOrders
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function orderDetails($order_id)
    {
        try {
            $order = Cache::remember('order'.$order_id , 60*30 , function () use ($order_id) {
                $response = json_decode($this->likeCard->orderDetails($order_id));
                $order = $response ;
                return $order;
            });

        } catch (\Throwable $th) {
            $order = [] ;
        }

        return view("front.order_details", compact("order"));
    }

    /**
     * Method getPaymentPage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPaymentPage(Request $request)
    {
        session()->put('productId', $request->product_id);
        session()->put('productImage', $request->productImage);
        session()->put('productPrice', $request->productPrice);
        session()->put('productName', $request->productName);
        session()->put('productCurrency', $request->productCurrency);

        $productId   = $request->product_id;
        $productImage = $request->productImage;
        $productPrice = $request->productPrice;
        $productName = $request->productName;
        $productCurrency = $request->productCurrency;
        return view("front.payment",compact('productId','productImage','productPrice','productName','productCurrency'));
    }

    /**
     * Method getPaymentPageGet
     *
     * @param Request $request
     *
     * @return void
     */
    public function getPaymentPageGet(Request $request)
    {
        $productId   = session()->get('productId');
        $productImage = session()->get('productImage');
        $productPrice = session()->get('productPrice');
        $productName = session()->get('productName');
        $productCurrency = session()->get('productCurrency');
        return view("front.payment",compact('productId','productImage','productPrice','productName','productCurrency'));
    }
}
