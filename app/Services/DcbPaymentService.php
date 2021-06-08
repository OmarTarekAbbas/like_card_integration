<?php

namespace App\Services;

use App\Constants\OrderStatus;
use App\Constants\PaymentType;
use App\Order;
use Mail;
class DcbPaymentService implements PaymentInterface
{
  /**
   * error
   *
   * @var string
   */
  private $error;

  /**
   * success
   *
   * @var bool
   */
  private $success;

  /**
   * responseData
   *
   * @var object
   */
  private $responseData;

  /**
   * balance
   *
   * @var float
   */
  private $balance;

  /**
   * likeCard
   *
   * @var \App\Services\LikeCardService
   */
  private $likeCard;

  /**
   * dcbService
   *
   * @var \App\Services\DcbService
   */
  private $dcbService;

  /**
   * orderService
   *
   * @var \App\Services\OrderService
   */
  private $orderService;
  /**
   * clientService
   *
   * @var \App\Services\ClientService
   */
  private $clientService;

  /**
   * Method __construct
   *
   * @param \App\Services\LikeCardService $likeCard
   * @param \App\Services\DcbService $dcbService
   * @param \App\Services\OrderService $orderService
   * @param \App\Services\ClientService $clientService
   */
  public function __construct(LikeCardService $likeCard, DcbService $dcbService, OrderService $orderService, ClientService $clientService)
  {
      $this->likeCard      = $likeCard;
      $this->dcbService    = $dcbService ;
      $this->orderService  = $orderService ;
      $this->clientService = $clientService ;
  }

  /**
   * Method buyItems
   *
   * i'll describe all case that will happend in this function
   *
   * 1- first check that balance that we have in like card more than order total price
   *
   * 2- pay with Dcb service by take the total price, pincode and verify after that pay
   *
   * 3- create order from like card after that create order in our database and store all needed data
   * @param array $data
   * @return void
   */
  public function buyItems($data)
  {
      try {
        $response = $this->dcbService->verifyDOBCharging($data);
        if(!$response['status']) {
          $this->success = false;
          $this->error   = $response['message'];
        } else {
          $data['pincode_verify_id'] = $response['pincode_verify_id'];
          $data['dcb_status'] = $response['dcb_status'];
          $this->createOrderFromLikeCard($data);
        }
      } catch ( \Exception $e ) {
        $this->success = false;
        $this->error   = "حدث خطأ اثناء الدفع";
      }
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
        $this->sucess = true;
        $this->updateOrderFromOurSide($data, $response);
      } else {
        $this->sucess = false;
        $this->error   = "لانستطيع الشراء من البائع الاصلى";
      }
    } catch (\Throwable $th) {
      $this->success = false;
      $this->error   = "حدث خطأ اثناء الشراء من البائع الاصلى";
    }
  }

  /**
   * Method updateOrderFromOurSide
   *
   * update [status, dcb_status, payment_type, transaction_id, serial_id, hash_serial_code, serial_code, valid_to]
   *
   * @param array $data [pincode_verify_id, dec_status]
   * @param object $response [this our order that in database]
   * @return void
   */
  public function updateOrderFromOurSide($data, $response)
  {
    $currentOrder = Order::where("client_id", auth()->guard("client")->user()->id)->where("payment", PaymentType::NO_PAYMENT)->where("status", OrderStatus::PENDING)->latest()->first();
    $data['status']           = OrderStatus::FINISHED;
    $data['payment']          = PaymentType::DCB;
    $data['transaction_id']   = $response->orderId;
    $data['serial_id']        = $response->serials[0]->serialId;
    $data['hash_serial_code'] = $response->serials[0]->serialCode;
    $data['serial_code']      = $this->likeCard->decryptSerial($response->serials[0]->serialCode);
    $data['valid_to']         = $response->serials[0]->validTo;
    $this->orderService->handle($data, $currentOrder);
    $this->clientService->sendMailToUserWithSerialCode($data['serial_code']);
    $this->responseData = $currentOrder;
  }

  /**
   * Method getError
   *
   * @return string
   */
  public function getError()
  {
      if (!$this->error) {
          return trans("un handle sms error");
      }
      return $this->error;
  }

  /**
   * Method isSuccess
   *
   * @return bool
   */
  public function isSuccess()
  {
      if (!isset($this->success)) {
          return false;
      }
      return $this->success;
  }

  /**
   * Method getData
   *
   * @return object
   */
  public function getData()
  {
      if (!isset($this->responseData)) {
          return (object)[];
      }
      return $this->responseData;
  }

}
