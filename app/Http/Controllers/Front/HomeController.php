<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LikeCardService;
use Cache;
use Illuminate\Support\Facades\Session;


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
     * Method listCategoryChilds
     *
     * @param int $parent_id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listCategoryChilds($parent_id)
    {
        $category = Cache::remember('category'.$parent_id, 60*60*5 , function () use ($parent_id) {
            $category  = $this->getSpecficCategory($parent_id);
            return $category;
        });

        return view("front.category", compact("category"));
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
     * Method getSpecficCategory
     *
     * @param integer $category_id
     *
     * @return array
     */
    public function getSpecficCategory($category_id)
    {
        try {
            $response   = json_decode($this->likeCard->Categories());
            $categories = $response->data ;
            $key        = array_search($category_id, array_column($categories, 'id'));
            $category  =  $categories[$key];
        } catch (\Throwable $th) {
            $category = [] ;
        }
        return $category;
    }

    /**
     * Method search
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        try {
            $products = Cache::remember('search'.$request->search , 60*60*24, function () use ($request){
                $category                       = json_decode($this->likeCard->Categories());
                $category_like_search_array     = $this->getCategoryLikeSearchValue($category->data, $request->search);
                $sub_category_like_search_array = $this->getSubCategoryLikeSearchValue($category_like_search_array, $request->search);
                $products                       = $this->getProductFromSubCategoryLikeSearchValue($sub_category_like_search_array, $request->search);
                return $products;
            });

        } catch (\Throwable $th) {
            $products = [] ;
        }

        return view("front.product", compact("products"));
    }

    /**
     * Method getCategoryLikeSearchValue
     *
     * @param array $categories [all category]
     * @param string $search_value [use like]
     *
     * @return array
     */
    public function getCategoryLikeSearchValue($categories, $search_value=null)
    {
      // $categories  = array_filter($categories, function($category) use ($search_value){
      //   return strpos(strtolower($category->categoryName), $search_value) !== false;
      // });
      return $categories;
    }

    /**
     * Method getSubCategoryLikeSearchValue
     *
     * @param array $categories [all search parent category]
     * @param string $search_value [use like]
     *
     * @return array
     */
    public function getSubCategoryLikeSearchValue($categories, $search_value=null)
    {
      foreach ($categories as $category) {
        // $subCategories[]  = array_filter($category->childs, function($subCategory) use ($search_value){
        //   return strpos(strtolower($subCategory->categoryName), $search_value) !== false;
        // });
        $subCategories[]  = $category->childs;
      }
      return call_user_func_array('array_merge', $subCategories);
    }

    /**
     * Method getProductFromSubCategoryLikeSearchValue
     *
     * @param array $subCategories [all search sub category]
     * @param string $search_value [use like]
     *
     * @return array
     */
    public function getProductFromSubCategoryLikeSearchValue($subCategories, $search_value)
    {

        foreach ($subCategories as $category) {
          $products[] = Cache::remember('products'.$category->id , 60*30 , function () use ($category, $search_value) {
              $response = json_decode($this->likeCard->Products($category->id));
              if($response->response){ //1 return data else no data
                  $products = array_filter($response->data, function($product) use ($search_value){
                    return strpos(strtolower($product->productName), $search_value) !== false;
                  });
                  return $products;
              }
          });
        }
      return call_user_func_array('array_merge', array_filter($products));
    }
}
