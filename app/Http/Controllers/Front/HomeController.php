<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\LikeCardService;

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
        $response   = json_decode($this->likeCard->Categories());
        $categories = $response->data ;
        return view("front.home", compact("categories"));
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
        $response   = json_decode($this->likeCard->products($category_id));
        $products = $response->data ;
        return view("front.product", compact("products"));
    }
}
