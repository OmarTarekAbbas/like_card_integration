<?php

namespace App\Http\Controllers\Front;

use App\Constants\OrderStatus;
use App\Constants\PaymentType;
use App\Http\Controllers\Controller;
use App\Myfatoorah;
use App\Order;
use App\Services\ClientService;
use App\Services\LikeCardService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{
	/* ------------------------ Configurations ---------------------------------- */
	//Test
	// visa 4005550000000001 05/18 123
	private $apiURL;
	private $apiKey;
  private $likeCard;
  private $orderService;
  private $isSuccess;
  private $order_id;
  private $myfatoorah_id;
  private $clientService;

	//Live
	//$this->apiURL = 'https://api.myfatoorah.com';
	//$this->apiKey = ''; //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token
	//
	//
	public function __construct(LikeCardService $likeCard, OrderService $orderService, ClientService $clientService)
	{
	  $this->apiURL       = env('MYFATOORAH_API_ENDPOINT');
		$this->apiKey       = env('MYFATOORAH_KEY');
    $this->likeCard     = $likeCard;
    $this->orderService = $orderService;
    $this->clientService= $clientService;
    $this->isSuccess    = true;
    $this->order_id     = null;
    $this->myfatoorah_id= null;
	}

	public function redirectToPaymentPage(Request $request)
	{
		/* ------------------------ Call InitiatePayment Endpoint ------------------- */
    //login with user
    if(!auth()->guard('client')->check()){
      $this->clientService->registerAndLogin($request->email);
    }
    //init order with pending status
    $order = $this->orderService->handle($request->all());
    $this->order_id = $order->id;

		//Fill POST fields array
		$total_price = round($request->sell_price * $request->quantity, 2);
		$ipPostFields = ['InvoiceAmount' => $total_price, 'CurrencyIso' => $request->currency];

    // check balance
    $this->checkBalance($total_price);
    if(!$this->isSuccess){
      return back();
    }

		//Call endpoint
		$paymentMethods = $this->initiatePayment($this->apiURL, $this->apiKey, $ipPostFields);

    //check if erro happend when call initiatePayment function
    if(!$this->isSuccess) {
      return back();
    }

		//You can save $paymentMethods information in database to be used later
		foreach ($paymentMethods as $pm) {
		    if ($pm->PaymentMethodEn == PaymentType::getLabel($request->payment)) {
		        $paymentMethodId = $pm->PaymentMethodId;
		        break;
		    }
		}

		/* ------------------------ Call ExecutePayment Endpoint -------------------- */
		//Fill customer address array
		/* $customerAddress = array(
		  'Block'               => 'Blk #', //optional
		  'Street'              => 'Str', //optional
		  'HouseBuildingNo'     => 'Bldng #', //optional
		  'Address'             => 'Addr', //optional
		  'AddressInstructions' => 'More Address Instructions', //optional
		  ); */

		//Fill invoice item array
		/* $invoiceItems[] = [
		  'ItemName'  => 'Item Name', //ISBAN, or SKU
		  'Quantity'  => '2', //Item's quantity
		  'UnitPrice' => '25', //Price per item
		  ]; */

		//Fill POST fields array
		$postFields = [
		    //Fill required data
		    'paymentMethodId'    => $paymentMethodId,
		    'InvoiceValue'       => $total_price,
		    'CallBackUrl'        => route('front.myfatoorah.handle.callback'),
		    'ErrorUrl'           => route('front.myfatoorah.handle.callback'),
        'CustomerReference'  => $this->order_id,
		        //Fill optional data
		        //'CustomerName'       => 'fname lname',
		        //'DisplayCurrencyIso' => 'KWD',
		        //'MobileCountryCode'  => '+965',
		        //'CustomerMobile'     => '1234567890',
		        //'CustomerEmail'      => 'email@example.com',
		        //'Language'           => 'en', //or 'ar'
		        //'CustomerCivilId'    => 'CivilId',
		        //'UserDefinedField'   => 'This could be string, number, or array',
		        //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
		        //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
		        //'CustomerAddress'    => $customerAddress,
		        //'InvoiceItems'       => $invoiceItems,
		];

		//Call endpoint
		$data = $this->executePayment($this->apiURL, $this->apiKey, $postFields);
    if(!$this->isSuccess) {
      return back();
    }

    //save myfatoorah info
    $post['invoice_id'] = $data->InvoiceId;
    $post['payment_url'] = $data->PaymentURL;
    $post['payment_method'] = PaymentType::getLabel($request->payment);
    $this->updateMyfatoorah($post);


		return redirect()->away($data->PaymentURL);
	}

	/* ------------------------ Functions --------------------------------------- */
	/*
	 * Initiate Payment Endpoint Function
	 */

	public function initiatePayment($apiURL, $apiKey, $postFields)
  {
	    $json = $this->callAPI("$apiURL/v2/InitiatePayment", $apiKey, $postFields);
      if(!$this->isSuccess) {
        return ;
      }
	    return $json->Data->PaymentMethods;
	}

	//------------------------------------------------------------------------------
	/*
	 * Execute Payment Endpoint Function
	 */

	public function executePayment($apiURL, $apiKey, $postFields)
  {
	    $json = $this->callAPI("$apiURL/v2/ExecutePayment", $apiKey, $postFields);
      if(!$this->isSuccess) {
        return ;
      }
	    return $json->Data;
	}

	//------------------------------------------------------------------------------
	/*
	 * Call API Endpoint Function
	 */

	public function callAPI($endpointURL, $apiKey, $postFields)
  {
	    $curl = curl_init($endpointURL);
	    curl_setopt_array($curl, array(
	        CURLOPT_CUSTOMREQUEST  => "POST",
	        CURLOPT_POSTFIELDS     => json_encode($postFields),
	        CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
	        CURLOPT_RETURNTRANSFER => true,
	    ));

	    $response = curl_exec($curl);
	    $curlErr  = curl_error($curl);

	    curl_close($curl);

	    if ($curlErr) {
	        //Curl is not working in your server
          $this->isSuccess = false;
          session()->flash("faild", $curlErr);
	        // die("Curl Error: $curlErr");
	    }

	    $error = $this->handleError($response);
	    if ($error) {
          $this->isSuccess = false;
          session()->flash("faild", $error);
	        // die("Error: $error");
	    }
      $type = explode('/', $endpointURL);
      if(end($type) == "getPaymentStatus") {
        $data = json_decode($response);
        $this->order_id = $data->Data->CustomerReference;
      }
      $this->log($endpointURL, json_encode($postFields), $response, end($type));
	    return json_decode($response);
	}

	//------------------------------------------------------------------------------
	/*
	 * Handle Endpoint Errors Function
	 */

	public function handleError($response)
  {

	    $json = json_decode($response);
	    if (isset($json->IsSuccess) && $json->IsSuccess == true) {
	        return null;
	    }

	    //Check for the errors
	    if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
	        $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
	        $blogDatas = array_column($errorsObj, 'Error', 'Name');

	        $error = implode(', ', array_map(function ($k, $v) {
	                    return "$k: $v";
	                }, array_keys($blogDatas), array_values($blogDatas)));
	    } else if (isset($json->Data->ErrorMessage)) {
	        $error = $json->Data->ErrorMessage;
	    }

	    if (empty($error)) {
	        $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
	    }

	    return $error;
	}

	/* -------------------------------------------------------------------------- */
   //  {"InvoiceId","InvoiceStatus","InvoiceReference","CustomerReference":,"CreatedDate","ExpiryDate","InvoiceValue","Comments","CustomerName","CustomerMobile","CustomerEmail","UserDefinedField","InvoiceDisplayValue","InvoiceItems","InvoiceTransactions": [ {"TransactionDate","PaymentGateway","ReferenceId","TrackId","TransactionId","PaymentId","AuthorizationId","TransactionStatus","TransationValue",CustomerServiceCharge","DueValue","PaidCurrency","PaidCurrencyValue","Currency","Error","CardNumber",}],"Suppliers": []}

	public function handleCallback(Request $request)
	{
		/* ------------------------ Call getPaymentStatus Endpoint ------------------ */
		//Inquiry using paymentId
		$keyId   = $request->paymentId;
		$KeyType = 'paymentId';

		//Fill POST fields array
		$postFields = [
		    'Key'     => $keyId,
		    'KeyType' => $KeyType
		];

		//Call endpoint
		$json       = $this->callAPI("$this->apiURL/v2/getPaymentStatus", $this->apiKey, $postFields);

    if(!$this->isSuccess) {
      return redirect('payment');
    }

    if($json->Data->InvoiceStatus != OrderStatus::getLabel(OrderStatus::FINISHED))
    {
      $this->updateOrder($json->Data, $json->Data->CustomerReference);
      session()->flash("faild", "Transaction status is ".$json->Data->InvoiceTransactions[0]->TransactionStatus);
      return redirect('payment');
    }

    $this->createOrderFromLikeCard($json->Data);

    if(!$this->isSuccess) {
      return redirect('payment');
    }

    //save myfatoorah info
    $post['invoice_status']       = $json->Data->InvoiceStatus;
    $post['transaction_status']   = $json->Data->InvoiceTransactions[0]->TransactionStatus;
    $post['payment_id']           = $request->paymentId;
    $this->updateMyfatoorah($post);

		//Display the payment result to your customer
		session()->flash("success", "Your Order Create Successfully");
    return redirect()->route("front.order.details",["order_id" => $json->Data->CustomerReference]);
	}


  public function updateOrder($response, $order_id)
  {
    $order = Order::find($order_id);
    $order->payment = PaymentType::getKey($response->InvoiceTransactions[0]->PaymentGateway);
    $order->status  = OrderStatus::getKey($response->InvoiceStatus);
    $order->myfatoorah_id  = $this->myfatoorah_id;
    $order->save();
  }

   /**
   * Method createOrderFromLikeCard
   *
   * @param array $data [productId, quantity]
   *
   * @return void
   */
  public function createOrderFromLikeCard($data)
  {
    try {
      $response = json_decode($this->likeCard->createOrder(session("productId"), session("quantity")));
      if($response->response) {
        $this->isSuccess = true;
        $this->updateOrderFromOurSide($data, $response);
      } else {
        $this->isSuccess = false;
        session()->flash("faild", "لانستطيع الشراء من البائع الاصلى");
      }
    } catch (\Throwable $th) {
      $this->isSuccess = false;
      session()->flash("faild", "حدث خطأ اثناء الشراء من البائع الاصلى");
    }
  }

  /**
   * Method updateOrderFromOurSide
   *
   * update [status, dcb_status, payment_type, transaction_id, serial_id, hash_serial_code, serial_code, valid_to]
   *
   * @param object $data [pincode_verify_id, dec_status]
   * @param object $response [this our order that in database]
   * @return void
   */
  public function updateOrderFromOurSide($data, $response)
  {
    $currentOrder = Order::find($data->CustomerReference);
    $post['status']           = OrderStatus::FINISHED;
    $post['payment']          = PaymentType::getKey($data->InvoiceTransactions[0]->PaymentGateway);
    $post['transaction_id']   = $response->orderId;
    $post['serial_id']        = $response->serials[0]->serialId;
    $post['hash_serial_code'] = $response->serials[0]->serialCode;
    $post['serial_code']      = $this->likeCard->decryptSerial($response->serials[0]->serialCode);
    $post['valid_to']         = $response->serials[0]->validTo;
    $post['myfatoorah_id']    = $this->myfatoorah_id;
    $this->orderService->handle($post, $currentOrder);
    $this->clientService->sendMailToUserWithSerialCode($post['serial_code']);
  }

  /**
   * Method checkBalance
   *
   * @param float $data
   * @return array
   */
  private function checkBalance($total_price)
  {
    try {
      $response = json_decode($this->likeCard->checkBalance());
      $this->balance = $response->balance ;

      if($this->balance < $total_price) {
        $this->isSuccess = false;
        session()->flash("faild", "لانستطيع الشراء من البائع الاصلى");
      }
    } catch (\Throwable $th) {
      $this->isSuccess = false;
      session()->flash("faild", "حدث خطأ اثناء الشراء");
    }

  }

  private function log($url, $request, $response, $type)
  {
    $myfatoorah = Myfatoorah::create([
      'url'      => $url,
      'request'  => $request,
      'response' => $response,
      'type'     => $type,
      'order_id' => $this->order_id
    ]);
    $this->myfatoorah_id = $myfatoorah->id;
  }

  public function updateMyfatoorah($data)
  {
    $myfatoorah = Myfatoorah::find($this->myfatoorah_id);
    $myfatoorah->update($data);
  }

}
