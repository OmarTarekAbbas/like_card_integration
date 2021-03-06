<?php

namespace App\Services;

use App\LikeCard;

class LikeCardService
{
    /**
     * Method test_check_balance
     *
     * check balance That We Have
     * @return string|bool
     */
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
    /**
     * Method checkBalance
     *
     * check balance That We Have
     * @return string|bool
     */
    public function checkBalance()
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

    /**
     * Method categories
     *
     * @return string|bool
     */
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

    /**
     * Method products
     *
     * @param int $category_id
     * @return string|bool
     */
    public function Products($category_id)
    {
        $URL = 'https://taxes.like4app.com/online/products';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => langIdEn, 'categoryId' => $category_id);
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

    /**
     * Method productsWithOptional
     *
     * @param int $category_id
     * @return string|bool
     */
    public function productsWithOptional($category_id)
    {
        $URL = 'https://taxes.like4app.com/online/products';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => langIdEn, 'categoryId' => $category_id);
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

    /**
     * Method Orders
     *
     * @return string|bool
     */
    public function Orders()
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

    /**
     * Method orderDetails
     *
     * @param Integer $order_id [explicite description]
     *
     * @return string|bool
     */
    public function orderDetails($order_id)
    {
        $URL = 'https://taxes.like4app.com/online/orders/details';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => langIdEn, 'orderId' => $order_id);
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

    /**
     * Method createOrder
     *
     * @param int $product_id
     * @param int $quantity
     * @return string|bool
     */
    public function createOrder($product_id, $quantity)
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

    /**
     * Method sendMailToAdmin
     *
     * @param float $balance
     *
     * @return void
     */
    public function sendMailToAdmin($balance)
    {
      $admin_mail = get_setting('admin_mail') == ''? admin_mail : get_setting('admin_mail');
      \Mail::send('front.mails.our_balance', ['balance' => $balance], function ($m) use($admin_mail){
        $m->from('digicards@digizone.com.kw', env('ORDER_SUBJECT'));
        $m->to($admin_mail, 'like Card')->subject('Balance Limit');
      });
    }
}
