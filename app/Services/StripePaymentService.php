<?php

namespace App\Services;


class StripePaymentService
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
   * @var LikeCardService
   */
  private $likeCard;

  /**
   * Method __construct
   *
   * @param LikeCardService $likeCard
   */
  public function __construct(LikeCardService $likeCard)
  {
      $this->likeCard = $likeCard;
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
        \Stripe\Charge::create([
          "amount" => 300 * 100,
          "currency" => "usd",
          "source" => $data['stripeToken'],
          "description" => "Test payment."
        ]);
      } catch ( \Exception $e ) {
        $this->success = false;
        $this->error   = "error when buy from stripe getway";
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
