<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LikecartController extends Controller
{

    public function check_balance()
    {
        $URL = 'https://taxes.like4app.com/online/check_balance/';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => '1');
        $this->GetPageData($URL,$parameter);
    }

    public function categories()
    {
        $URL = 'https://taxes.like4app.com/online/categories';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => '1');
        $this->GetPageData($URL,$parameter);
    }


    public function products()
    {
        $URL = 'https://taxes.like4app.com/online/products';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => '1', 'categoryId' => '96');
        $this->GetPageData($URL,$parameter);
    }

    public function products_with_optiona()
    {
        $URL = 'https://taxes.like4app.com/online/products';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => '1', 'categoryId' => '96');
        $this->GetPageData($URL,$parameter);
    }

    public function orders()
    {
        $URL = 'https://taxes.like4app.com/online/orders';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => '1', 'categoryId' => '96');
        $this->GetPageData($URL,$parameter);
    }

    public function order_details()
    {
        $URL = 'https://taxes.like4app.com/online/orders/details';
        $parameter = array('deviceId' => deviceId, 'email' => email, 'password' => password, 'securityCode' => securitycode, 'langId' => '1', 'categoryId' => '96','orderId' => '');
        $this->GetPageData($URL,$parameter);
    }

    public function create_order()
    {
        $URL = 'https://taxes.like4app.com/online/create_order';

        $parameter = array('deviceId' => deviceId,'email' => email,'password' => password,'securityCode' => securitycode,'langId' => '1','time' => '','hash' => hash_key,'productId' => '376','quantity' => '1','optionalFields' => '[{"optionId":"499","optionalFieldID":"14","value":"VALUE...."}]','time' => '1576704145','hash' => '27c47fc6865008c0e529d24678deaf15a52255e6827023921bb49132ba950906');

        $this->GetPageData($URL,$parameter);

    }


    public static function GetPageData($URL , $parameter)
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
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    
}
