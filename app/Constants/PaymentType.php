<?php


namespace App\Constants;


final class PaymentType
{
  const NO_PAYMENT         = 0;
  const DCB                = 1;

  public static function getList()
  {
      return [
          self::NO_PAYMENT       => trans('no payment yet'),
          self::DCB              => trans('DCB'),
      ];
  }

  public static function getLabel($key)
  {
      return self::getList()[$key];
  }
}
