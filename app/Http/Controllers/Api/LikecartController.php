<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\LikeCard;


class LikecartController extends Controller
{

    public function test_check_balance()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://taxes.like4app.com/online/check_balance/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('deviceId' => '31e0f17d72b7f0ef674fa6f1a102822de7e088613cb5ee24b67198d582a1c06d','email' => 'emad@ivas.com.eg','password' => 'b0844ea720cffe4f18e8e10e3cad0a33593c62ea8968851398d22bd75e6185a6','securityCode' => '99498b770cd4927e39131afc1cf65cc7b3450c42f76099d78e57029a5ec52235','langId' => '1'),

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;




    }




    public function check_balance()
    {
        $URL = 'https://taxes.like4app.com/online/check_balance';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => langIdEn);
        //make curl for functions GetPageData
        $response = $this->GetPageData($URL, $parameter);
        //save for database
        $likecard = new LikeCard();
        $likecard->req = json_encode($parameter);
        $likecard->response = $response;
        $likecard->url = $URL;
        $likecard->function_name = 'check_balance';
        $likecard->save();
        return $response;
    }

    public function Categories()
    {
        $URL = 'https://taxes.like4app.com/online/categories';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => langIdEn);
        //make curl for functions GetPageData
        $response = $this->GetPageData($URL, $parameter);

        //save for database
        $likecard = new LikeCard();
        $likecard->req = json_encode($parameter);
        $likecard->response = $response;
        $likecard->url = $URL;
        $likecard->function_name = 'categories';
        $likecard->save();
        return $response;
    }

    public function Products()
    {
        $URL = 'https://taxes.like4app.com/online/products';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => langIdEn, 'categoryId' => categoryId);
        //make curl for functions GetPageData
        $response = $this->GetPageData($URL, $parameter);

        //save for database
        $likecard = new LikeCard();
        $likecard->req = json_encode($parameter);
        $likecard->response = $response;
        $likecard->url = $URL;
        $likecard->function_name = 'products';
        $likecard->save();
        return $response;
    }

    public function products_with_optiona()
    {
        $URL = 'https://taxes.like4app.com/online/products';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => langIdEn, 'categoryId' => categoryId);
        //make curl for functions GetPageData
        $response = $this->GetPageData($URL, $parameter);

        //save for database
        $likecard = new LikeCard();
        $likecard->req = json_encode($parameter);
        $likecard->response = $response;
        $likecard->url = $URL;
        $likecard->function_name = 'products_with_optiona';
        $likecard->save();
        return $response;
    }

    public function orders()
    {
        $URL = 'https://taxes.like4app.com/online/orders';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => langIdEn);
        //make curl for functions GetPageData
        $response = $this->GetPageData($URL, $parameter);

        //save for database
        $likecard = new LikeCard();
        $likecard->req = json_encode($parameter);
        $likecard->response = $response;
        $likecard->url = $URL;
        $likecard->function_name = 'orders';
        $likecard->save();
        return $response;
    }

    public function order_details()
    {
        $URL = 'https://taxes.like4app.com/online/orders/details';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => langIdEn, 'orderId' => orderId);
        //make curl for functions GetPageData
        $response = $this->GetPageData($URL, $parameter);

        //save for database
        $likecard = new LikeCard();
        $likecard->req = json_encode($parameter);
        $likecard->response = $response;
        $likecard->url = $URL;
        $likecard->function_name = 'order_details';
        $likecard->save();
        return $response;
    }

    public function create_order()
    {
        $URL = 'https://taxes.like4app.com/online/create_order';
        //1614078108
        $timestamp = strtotime("now");
        $hash = $this->generateHash($timestamp);
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => langIdEn, 'productId' => productId, 'quantity' => quantity, 'optionalFields' => '[{"optionId":"499","optionalFieldID":"14","value":"VALUE...."}]', 'time' => $timestamp, 'hash' => $hash);
        //make curl for functions GetPageData
        $response = $this->GetPageData($URL, $parameter);

        //save for database
        $likecard = new LikeCard();
        $likecard->req = json_encode($parameter);
        $likecard->response = $response;
        $likecard->url = $URL;
        $likecard->function_name = 'create_order';
        $likecard->save();
        return $response;
    }

    public static function GetPageData($URL, $parameter)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $parameter,

        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function generateHash($timestamp)
    {
        $email = strtolower(email);
        $phone = phone;
        $key = key;
        return hash('sha256', $timestamp . $email . $phone . $key);
    }

    public function decryptSerial($encrypted_txt)
    {
        $secret_key = secret_key;
        $secret_iv = secret_iv;
        $encrypt_method = encrypt_method;
        $key = hash('sha256', $secret_key);
        //iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        return openssl_decrypt(base64_decode($encrypted_txt), $encrypt_method, $key, 0, $iv);
    }

}
