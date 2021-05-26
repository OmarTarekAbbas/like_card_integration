<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{
	/* ------------------------ Configurations ---------------------------------- */
	//Test
	private $apiURL;
	private $apiKey;

	//Live
	//$this->apiURL = 'https://api.myfatoorah.com';
	//$this->apiKey = ''; //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token
	//
	//
	public function __construct()
	{
	    $this->apiURL = env('MYFATOORAH_API_ENDPOINT');
		$this->apiKey = env('MYFATOORAH_KEY');
	}

	public function redirectToPaymentPage(Request $request)
	{
		// dd(route('front.myfatoorah.handle.callback'));
		/* ------------------------ Call InitiatePayment Endpoint ------------------- */
		//Fill POST fields array
		$total_price = $request->sell_price * $request->quantity;
		$ipPostFields = ['InvoiceAmount' => $total_price, 'CurrencyIso' => $request->currency];

		//Call endpoint
		$paymentMethods = $this->initiatePayment($this->apiURL, $this->apiKey, $ipPostFields);

		//You can save $paymentMethods information in database to be used later
		foreach ($paymentMethods as $pm) {
		    if ($pm->PaymentMethodEn == $request->payment_method) {
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
		    'paymentMethodId' => $paymentMethodId,
		    'InvoiceValue'    => $total_price,
		    'CallBackUrl'     => route('front.myfatoorah.handle.callback'),
		    'ErrorUrl'        => route('front.myfatoorah.handle.callback'),   
		        //Fill optional data
		        //'CustomerName'       => 'fname lname',
		        //'DisplayCurrencyIso' => 'KWD',
		        //'MobileCountryCode'  => '+965',
		        //'CustomerMobile'     => '1234567890',
		        //'CustomerEmail'      => 'email@example.com',
		        //'Language'           => 'en', //or 'ar'
		        //'CustomerReference'  => 'orderId',
		        //'CustomerCivilId'    => 'CivilId',
		        //'UserDefinedField'   => 'This could be string, number, or array',
		        //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
		        //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
		        //'CustomerAddress'    => $customerAddress,
		        //'InvoiceItems'       => $invoiceItems,
		];

		//Call endpoint
		$data = $this->executePayment($this->apiURL, $this->apiKey, $postFields);

		//You can save payment data in database as per your needs
		$invoiceId   = $data->InvoiceId;
		$paymentLink = $data->PaymentURL;

		//Redirect your customer to the payment page to complete the payment process
		//Display the payment link to your customer
		// echo "Click on <a href='$paymentLink' target='_blank'>$paymentLink</a> to pay with invoiceID $invoiceId.";
		// 
		return redirect()->away($paymentLink);
	}

	/* ------------------------ Functions --------------------------------------- */
	/*
	 * Initiate Payment Endpoint Function 
	 */

	public function initiatePayment($apiURL, $apiKey, $postFields) {

	    $json = $this->callAPI("$this->apiURL/v2/InitiatePayment", $this->apiKey, $postFields);
	    return $json->Data->PaymentMethods;
	}

	//------------------------------------------------------------------------------
	/*
	 * Execute Payment Endpoint Function 
	 */

	public function executePayment($apiURL, $apiKey, $postFields) {

	    $json = $this->callAPI("$this->apiURL/v2/ExecutePayment", $this->apiKey, $postFields);
	    return $json->Data;
	}

	//------------------------------------------------------------------------------
	/*
	 * Call API Endpoint Function
	 */

	public function callAPI($endpointURL, $apiKey, $postFields) {

	    $curl = curl_init($endpointURL);
	    curl_setopt_array($curl, array(
	        CURLOPT_CUSTOMREQUEST  => "POST",
	        CURLOPT_POSTFIELDS     => json_encode($postFields),
	        CURLOPT_HTTPHEADER     => array("Authorization: Bearer $this->apiKey", 'Content-Type: application/json'),
	        CURLOPT_RETURNTRANSFER => true,
	    ));

	    $response = curl_exec($curl);
	    $curlErr  = curl_error($curl);

	    curl_close($curl);

	    if ($curlErr) {
	        //Curl is not working in your server
	        die("Curl Error: $curlErr");
	    }

	    $error = $this->handleError($response);
	    if ($error) {
	        die("Error: $error");
	    }

	    return json_decode($response);
	}

	//------------------------------------------------------------------------------
	/*
	 * Handle Endpoint Errors Function 
	 */

	public function handleError($response) {

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

	public function handleCallback(Request $request)
	{
		/* ------------------------ Call getPaymentStatus Endpoint ------------------ */
		//Inquiry using paymentId
		$keyId   = $request->paymentId;
		$KeyType = 'paymentId';

		//Inquiry using invoiceId 
		/*$keyId   = '613842';
		$KeyType = 'invoiceId';*/

		//Fill POST fields array
		$postFields = [
		    'Key'     => $keyId,
		    'KeyType' => $KeyType
		];
		//Call endpoint
		$json       = $this->callAPI("$this->apiURL/v2/getPaymentStatus", $this->apiKey, $postFields);

		//Display the payment result to your customer
		return  $json->Data->InvoiceStatus;
	}

}