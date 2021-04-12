<?php


namespace App\Constants;


final class PaymentType
{
  const CASH               = 1;
  const STRIPE             = 2;

  public static function getList()
  {
      return [
          self::CASH                => trans('cash'),
          self::STRIPE              => trans('stripe'),
      ];
  }

  public static function getLabel($key)
  {
      return self::getList()[$key];
  }
}
