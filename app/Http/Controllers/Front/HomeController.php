<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LikeCardService;
use Cache;
class HomeController extends Controller
{
    /**
     * likeCard
     *
     * @var LikeCardService
     */
    private $likeCard;

    /**
     * Method __construct
     *
     * @param LikeCardService $likeCard
     */
    public function __construct(LikeCardService $likeCard)
    {
        $this->likeCard = $likeCard;
    }

    /**
     * Method index
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view("front.home");
    }

    /**
     * Method listProducts
     *
     * @param integer $category_id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listProducts($category_id)
    {
        try {
            $products = Cache::remember('products'.$category_id , 60*30 , function () use ($category_id) {
                $response = json_decode($this->likeCard->Products($category_id));
                $products = $response->data ;
                return $products;
            });

        } catch (\Throwable $th) {
            $products = [] ;
        }

        return view("front.product", compact("products"));
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
        try {
            $response = json_decode($this->likeCard->createOrder($request->product_id));
            if($response->response) {
                session()->flash("success", "Order Create Successfully");
            } else {
                session()->flash("faild", $response->message);
            }

        } catch (\Throwable $th) {
            session()->flash("faild", "There Are Error In Api");
        }

        return redirect()->route("front.orders");
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
            $order = Cache::remember('orders'.$$order_id , 60*30 , function () use ($order_id) {
                $response = json_decode($this->likeCard->orderDetails($order_id));
                $order = $response->data ;
                return $order;
            });

        } catch (\Throwable $th) {
            $order = [] ;
        }

        return view("front.order_details", compact("order"));
    }
}
