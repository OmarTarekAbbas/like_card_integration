<?php

namespace App\Services;

use App\Constants\OrderStatus;
use App\Constants\PaymentStatus;
use App\Constants\PaymentType;
use App\Order;
use App\OrderItem;
use Faker\Provider\ar_SA\Payment;

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
   * Method __construct
   *
   * @param \App\Services\LikeCardService $likeCard
   * @param \App\Services\DcbService $dcbService
   * @param \App\Services\OrderService $orderService
   */
  public function __construct(LikeCardService $likeCard, DcbService $dcbService, OrderService $orderService)
  {
      $this->likeCard      = $likeCard;
      $this->dcbService    = $dcbService ;
      $this->orderService  = $orderService ;
  }

  /**
   * Method checkBalance
   *
   * @param float $data
   * @return void
   */
  private function checkBalance($total_price)
  {
    try {
      $response = json_decode($this->likeCard->checkBalance());
      $this->balance = $response->balance ;
      $this->success = true;
      if($this->balance < $total_price) {
        $this->error = "لايمكن شراء المنتج الان";
        $this->success = false;
      }
    } catch (\Throwable $th) {
      $this->error = "حدث خطأ اثناء الشراء";
      $this->success = false;
    }
  }

  /**
   * Method buyItems
   *
   * @param array $data
   *
   * @return void
   */
  public function buyItems($data)
  {
    $this->checkBalance($data['total_price']);
    if($this->success) {
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
  }

  /**
   * Method createOrderFromLikeCard
   *
   * @param array $data
   *
   * @return void
   */
  public function createOrderFromLikeCard($data)
  {
    try {
      $response = json_decode($this->likeCard->createOrder($data['product_id'], $data['quantity']));
      if($response->response) {
        $this->sucess = true;
        $this->updateOrderFromOurSide($data);
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
   * update status, dcb_status, payment_type
   * @param array $data [pincode_verify_id, dec_status]
   *
   * @return void
   */
  public function updateOrderFromOurSide($data)
  {
    $currentOrder = Order::where("client_id", auth()->guard("client")->user()->id)->where("payment", PaymentType::NO_PAYMENT)->where("status", OrderStatus::PENDING)->latest()->first();
    $data['status']          = OrderStatus::FINISHED;
    $data['payment']         = PaymentType::DCB;
    $data['transaction_id']  = $this->responseData->order_id;
    $this->orderService->handle($data, $currentOrder);
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
