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
        $this->error = "You Can't But This Item Now";
        $this->success = false;
      }
    } catch (\Throwable $th) {
      $this->error = "error when get check balance";
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
          $this->error   = "canb't charge when verify pincode";
        }
      } catch ( \Exception $e ) {
        $this->success = false;
        $this->error   = "error when buy from dcb getway";
      } finally {
        $data['pincode_verify_id'] = $response['pincode_verify_id'];
        $this->createOrderFromLikeCard($data);
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
        $this->responseData = $response;
        $this->updateOrderFromOurSide($data);
      } else {
        $this->sucess = false;
        $this->error   = "You Can't Buy From Like Card";
      }
    } catch (\Throwable $th) {
      $this->success = false;
      $this->error   = "error when buy from Like Card getway";
    }
  }

  /**
   * Method updateOrderFromOurSide
   *
   * update status, payment_status, payment_type
   * @param array $data [pincode_verify_id]
   *
   * @return void
   */
  public function updateOrderFromOurSide($data)
  {
    $currentOrder = Order::where("client_id", auth()->guard("client")->user()->id)->where("payment", PaymentType::NO_PAYMENT)->where("payment_status", PaymentStatus::Pending)->where("status", OrderStatus::PENDING)->latest()->first();
    $data['status']          = OrderStatus::FINISHED;
    $data['payment']         = PaymentType::DCB;
    $data['payment_status']  = PaymentStatus::Success;
    $data['transaction_id']  = $this->responseData->order_id;
    session()->put("serial_id", $this->responseData->serials[0]->serialId);
    session()->put("serial_code", $this->responseData->serials[0]->serialCode);
    session()->put("valid_to", $this->responseData->serials[0]->validTo);
    $this->orderService->handle($data, $currentOrder);
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
