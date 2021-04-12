<?php

namespace App\Services;

interface PaymentInterface
{
  /**
   * Method getError
   *
   * this function can with it but items and handle all checkout cycle
   * @param array $data
   * @return void
   */
  public function buyItems($data);

  /**
   * Method getError
   *
   * Get any error when payment cycle run
   * @return string
   */
  public function getError();

  /**
   * Method isSuccess
   *
   * check that payment done successfully
   * @return bool
   */
  public function isSuccess();

  /**
   * Method getData
   *
   * return response data that coming from payment
   * @return object
   */
  public function getData();
}
