<?php


namespace App\Services;

use App\Constants\DcbStatus;
use App\PincodeRequest;
use App\PincodeVerify;
use App\Msisdn;
use Illuminate\Http\Request;

class DcbService
{
  /**
   * Method pinCodeDCBRequest
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return array
   */
  public function pinCodeDCBRequest(Request $request)
  {
    // Authentication
    $User = User;
    $Password = Password;

    // End-User
    $MSISDN = $request->phone;   // 96555410856
    session("phone", $request->phone);

    // Applications/Service
    $ServiceID = ServiceID;
    $ChannelID = ChannelID;
    $ProfileID = ProfileID;


    // Operator
    $newValue = explode('-', $request->phone_code);
    $OperatorID = $newValue[0];  //https://en.wikipedia.org/w/index.php?title=Mobile_country_code&01123656796= and https://en.wikipedia.org/wiki/Mobile_Network_Codes_in_ITU_region_4xx_(Asia)#Kuwait_%E2%80%93_KW
    session()->put("operator_id", $OperatorID);

    // Request Info
    $RequestID = uniqid();
    $Request = 'DOB-RQ';

    $info = array(
      'User' => $User,
      'password' => $Password,
      'MSISDN' => $MSISDN,
      // 'TokenID' => $TokenID,
      // 'DeviceID' => $DeviceID,
      'ServiceID' => $ServiceID,
      'ChannelID' => $ChannelID,
      'ProfileID' => $ProfileID,
      'OperatorID' => $OperatorID,
      'RequestID' => $RequestID,
      'Request' => $Request,
    );

    $query = http_build_query($info);
    // User=$User&password=$Password&MSISDN=$MSISDN&TokenID=$TokenID&DeviceID=$DeviceID&ServiceID=$ServiceID&ChannelID=$ChannelID&ProfileID=$ProfileID&OperatorID=$OperatorID&RequestID=$RequestID&Request=$Request
    $ch = curl_init();
    $getUrl = "http://galaxyapi.idextelecom.com:80/Galaxy.ashx?$query";
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $getUrl);
    curl_setopt($ch, CURLOPT_TIMEOUT, 80);
    $response = curl_exec($ch);  // Status=1&Success-Code=10400&Subscriber-Unique-ID=1333070620&RequestId=20201229155314052   [ 10400 ]
    curl_close($ch);

    $actionName = 'PinCodeDOBRequest';

    $PincodeRequest['msisdn'] = $info['MSISDN'];
    // $PincodeRequest['device_id'] = $info['DeviceID'];
    $PincodeRequest['operator_id'] = $info['OperatorID'];
    $PincodeRequest['request_id'] = $info['RequestID'];
    $PincodeRequest['request'] =  $getUrl;
    $PincodeRequest['response'] = $response;


    $pincodeRequest = PincodeRequest::create($PincodeRequest);
    $out['pincode_request_id'] = $pincodeRequest->id;

    // check for success
    $segments = explode('&' ,$response);
    foreach($segments as $segment){
      $key = explode('=' ,$segment);
      $arr[$key[0]] = $key[1];
    }

    if($arr['Status'] == '1' && $arr['Success-Code'] == '10400'){
      $out['status']  = true;
      $out['message'] = "successfully picode request";
    } else {
      $out['message'] = DcbStatus::getLabel($arr['Error-Code']);
      $out['status']  = false;
    }

    $out['dcb_status'] = isset($arr['Success-Code']) ? $arr['Success-Code'] : $arr['Error-Code'];

    if(!enable_dcb) {
      $out['status']  = true;
      $out['message'] = "successfully picode request";
      $out['dcb_status'] = 1;
    }

    return $out;
  }

  /**
   * Method verifyDOBCharging
   *
   * @param array $data [pincode, total_price]
   *
   * @return array
   */
  public function verifyDOBCharging($data)
  {
    // Authentication
    $User = User;
    $Password = Password;

    // End-User
    $MSISDN = session("phone");


    // Applications/Service
    $ServiceID = ServiceID;
    $ChannelID = ChannelID;
    $ProfileID = ProfileID;

    // Operator
    $OperatorID = session("operator_id");
    $Price      = $data['total_price'];

    // Request Info
    $RequestID  = uniqid();
    $Request    = 'DOB-VR';
    $RequestPin = $data['pincode'];

    $info = array(
      'User' => $User,
      'password' => $Password,
      'MSISDN' => $MSISDN,
      // 'TokenID' => $TokenID,
      // 'DeviceID' => $DeviceID,
      'ServiceID' => $ServiceID,
      'ChannelID' => $ChannelID,
      'ProfileID' => $ProfileID,
      'OperatorID' => $OperatorID,
      'Price' => $Price,
      'RequestID' => $RequestID,
      'Request' => $Request,
      'RequestPin' => $RequestPin,
    );

    $query = http_build_query($info);
    // User=$User&password=$Password&MSISDN=$MSISDN&TokenID=$TokenID&DeviceID=$DeviceID&ServiceID=$ServiceID&ChannelID=$ChannelID&ProfileID=$ProfileID&OperatorID=$OperatorID&Price=$Price&RequestID=$RequestID&Request=$Request&RequestPin=$RequestPin
    $ch = curl_init();
    $getUrl = "http://galaxyapi.idextelecom.com:80/Galaxy.ashx?$query";
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $getUrl);
    curl_setopt($ch, CURLOPT_TIMEOUT, 80);
    $response = curl_exec($ch);    //   Status=1&Success-Code=10500&Error-Desc=DOB.UniqueID=80499&RequestId=20201231112823205   // biiling id

    curl_close($ch);
    $actionName = 'VerifyDOBCharging';

    $PincodeVerify['msisdn'] = $info['MSISDN'];
    // $PincodeVerify['device_id'] = $info['DeviceID'];
    $PincodeVerify['operator_id'] = $info['OperatorID'];
    $PincodeVerify['price'] = number_format((float)$info['Price'], 2, '.', '');;
    $PincodeVerify['request_id'] = $info['RequestID'];
    $PincodeVerify['pin'] = $info['RequestPin'];
    $PincodeVerify['request'] =  $getUrl;
    $PincodeVerify['response'] = $response;

     $pincodeVerify = PincodeVerify::create($PincodeVerify);
     $out['pincode_verify_id'] = $pincodeVerify->id;

    $segments = explode('&' ,$response);
    foreach($segments as $segment){
      $key = explode('=' ,$segment);
      $arr[$key[0]] = $key[1];
    }

    if($arr['Status'] == '1' && $arr['Success-Code'] == '10500'){

      $create_msisdn['msisdn'] = $info['MSISDN'];
      $create_msisdn['status'] = 1;
      $create_msisdn['unique_id'] = $arr['RequestId'];
      Msisdn::create($create_msisdn);

      $out['message'] = 'Your payment is success';
      $out['status']  = true;

    } else {
      $out['message'] = DcbStatus::getLabel($arr['Error-Code']);
      $out['status']  = false;
    }

    $out['dcb_status'] = isset($arr['Success-Code']) ? $arr['Success-Code'] : $arr['Error-Code'];

    if(!enable_dcb) {
      $out['status']  = true;
      $out['message'] = "Your payment is success";
      $out['dcb_status'] = 1;
    }

    return $out;
  }

  public function response_code($code)
  {
    switch ($code) {
        case '10101':
            return 'Unknown';
        case '10102':
            return 'Access Denied (Invalid IP)';
        case '10103':
            return 'Access Denied (Invalid Username And Password)';
        case '10104':
            return 'Invalid Operator ID';
        case '10105':
            return 'Invalid Request ID';
        case '10106':
            return 'Invalid Channel ID';
        case '10107':
            return 'Invalid MSISDN ID';
        case '10108':
            return 'Invalid Device ID';
        case '10109':
            return 'Invalid Token ID';
        case '10401':
            return 'Unknown';
        case '10402':
            return 'Invalid Live Backup';
        case '10403':
            return 'Invalid Price';
        case '10501':
            return 'Invalid Pin-Code';
        case '10502':
            return 'Invalid SDP Pin-Code';
        case '10503':
            return 'Unknown';
        case '10504':
            return 'Blacklisted Number';
        case '10505':
            return 'Billing Failed';
        default:
            return 'Unknown';
    }
  }
}
