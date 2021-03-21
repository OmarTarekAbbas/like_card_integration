<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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
            $products = Cache::remember('products'.$category_id , 60*60*5 , function () use ($category_id) {
                $response = json_decode($this->likeCard->Products($category_id));
                $products = $response->data ;
                return $products;
            });

        } catch (\Throwable $th) {
            $products = [] ;
        }

        return view("front.product", compact("products"));
    }
}
