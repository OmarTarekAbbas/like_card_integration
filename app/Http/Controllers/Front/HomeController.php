<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
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
     * @param Request $request [explicite description]
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createOrder(Request $request)
    {
        try {
            $response = json_decode($this->likeCard->createOrder($request->product_id));
            session()->flush("success", "Order Create Successfully");
        } catch (\Throwable $th) {
            session()->flush("faild", "There Are Error In Api");
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
            $orders = Cache::remember('orders', 60*30, function ()  {
                $response = json_decode($this->likeCard->Orders());
                $orders = $response->data ;
                return $orders;
            });

        } catch (\Throwable $th) {
            $orders = [] ;
        }

        return view("front.order", compact("orders"));
    }
}
