<?php

namespace App\Services;

interface PaymentInterface
{
   /**
   * Method buyItems
   *
   * i'll describe all case that will happend in this function
   *
   * 1- first check that balance that we have in like card more than order total price
   *
   * 2- pay with Dcb service by take the total price ,  pincode and verify after that pay
   *
   * 3- create order from like card after that create order in our database and store all needed data
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
