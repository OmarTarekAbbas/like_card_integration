<?php

namespace App\Services;

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
   * @var array
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
   * @return bool
   */
  public function buyItems($data)
  {
    $this->checkBalance($data['total_price']);
    if($this->success) {
      try {
        $response = $this->dcbService->verifyDOBCharging($data);
        if($response == 'faild') {
          $this->success = false;
          $this->error   = "canb't charge when verify pincode";
        }
      } catch ( \Exception $e ) {
        $this->success = false;
        $this->error   = "error when buy from dcb getway";
      }
      $this->createOrderFromLikeCard($data);
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
        $this->createOrderFromOurSide($data);
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
   * Method createOrderFromOurSide
   *
   * @param array $data
   *
   * @return void
   */
  public function createOrderFromOurSide($data)
  {
    $this->orderService->handle($data);
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
