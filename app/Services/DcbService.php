<?php


namespace App\Services;

use App\PincodeRequest;
use App\PincodeVerify;
use App\Msisdn;
use Illuminate\Http\Request;

class DcbService
{
  /**
   * Method dcb_pincode_request
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return string
   */
  public function dcb_pincode_request(Request $request)
  {
    // Authentication
    $User = User;
    $Password = Password;

    // End-User
    $MSISDN = auth()->guard("client")->user()->phone;
    $OperatorID = request("op_id")?? 20;

    // Applications/Service
    $ServiceID = ServiceID;
    $ChannelID = ChannelID;
    $ProfileID = ProfileID;

    // Request Info
    $RequestID = uniqid();
    $Request = 'DOB-RQ';

    $info = array(
      'User' => $User,
      'password' => $Password,
      'MSISDN' => $MSISDN,
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
    $PincodeRequest['operator_id'] = $info['OperatorID'];
    $PincodeRequest['request_id'] = $info['RequestID'];
    $PincodeRequest['request'] =  $getUrl;
    $PincodeRequest['response'] = $response;

    PincodeRequest::create($PincodeRequest);

    // check for success
    $segments = explode('&' ,$response);
    foreach($segments as $segment){
      $key = explode('=' ,$segment);
      $arr[$key[0]] = $key[1];
    }

    if($arr['Status'] == '1' && $arr['Success-Code'] == '10400'){
        $msg = 'success';
    }else{
        if(array_key_exists('Error-Code', $arr)){
            $msg = $this->response_code($arr['Error-Code']);
        }else{
            $msg = 'failed';
        }
    }

    return $msg;
  }

  /**
   * Method dcb_verify_charging
   *
   * @param array $data
   *
   * @return string
   */
  public function dcb_verify_charging($data)
  {
    // Authentication
    $User = User;
    $Password = Password;

    // End-User
    $MSISDN = $data['msisdn'];
    $OperatorID = $data['operatorID'];
    $Price = $data['price'];
    $RequestPin = $data['pin'];

    // Applications/Service
    $ServiceID = ServiceID;
    $ChannelID = ChannelID;
    $ProfileID = ProfileID;


    // Request Info
    $RequestID = uniqid();
    $Request = 'DOB-VR';

    $info = array(
      'User' => $User,
      'password' => $Password,
      'MSISDN' => $MSISDN,
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
    $PincodeVerify['price'] = $info['Price'];
    $PincodeVerify['request_id'] = $info['RequestID'];
    $PincodeVerify['pin'] = $info['RequestPin'];
    $PincodeVerify['request'] =  $getUrl;
    $PincodeVerify['response'] = $response;

    PincodeVerify::create($PincodeVerify);


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
        $msg = "success";
    }else{
        if(array_key_exists('Error-Code', $arr)){
            $msg = $this->response_code($arr['Error-Code']);
        }else{
            $msg = 'failed';
        }
    }

    return $msg;

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
