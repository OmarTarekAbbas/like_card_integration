<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\PincodeRequestFormRequest;
use App\Services\ClientService;
use App\Services\LikeCardService;
use App\Services\PaymentInterface;
use App\Services\DcbService;
use App\Services\OrderService;
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
     * dcbService
     *
     * @var \App\Services\DcbService
     */
    private $dcbService;

    /**
     * orderservice
     *
     * @var \App\Services\OrderService
     */
    private $orderService;

    /**
     * clientService
     *
     * @var \App\Services\ClientService
     */
    private $clientService;


    /**
     * Method __construct
     *
     * @param \App\Services\LikeCardService $likeCard
     * @param \App\Services\PaymentInterface $payment
     * @param \App\Services\DcbService $dcbService
     * @param \App\Services\OrderService $orderService
     * @param \App\Services\ClientService $clientService
     */
    public function __construct(
      LikeCardService $likeCard,
      PaymentInterface $payment,
      DcbService $dcbService,
      OrderService $orderService,
      ClientService $clientService
    ) {
        $this->likeCard      = $likeCard;
        $this->payment       = $payment ;
        $this->dcbService    = $dcbService ;
        $this->orderService  = $orderService ;
        $this->clientService = $clientService ;
    }

    /**
     * Method pincodeRequest
     *
     * @param \App\Http\Requests\PincodeRequestFormRequest $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pincodeRequest(PincodeRequestFormRequest $request)
    {
      //update user phone like he enter
      $this->clientService->handle($request->only("phone"), auth()->guard("client")->user());

      $response = $this->dcbService->pinCodeDCBRequest($request);
      if(!$response['status']) {
        session()->flash("faild", "error when make pincode request");
        return back();
      }

      //add pincode request id to order table to link them
      $request->request->add(['pincode_request_id' => $response['pincode_request_id']]);
      $this->orderService->handle($request->all());
      session()->flash("success", "pincode send successfully");
      return redirect()->route("front.pincode.verify");
    }

    /**
     * Method pincodeVerifyPage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pincodeVerifyPage()
    {
      return view("front.pincode");
    }

    /**
     * Method createOrder
     *
     * @param Illuminate\Http\Request $request [pincode, total_price]
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pincodeVerify(Request $request)
    {
      //add pincode request id to order table to link them
      $request->request->add(['total_price' => session("total_price")]);
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
