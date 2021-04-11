<?php


namespace App\Constants;


final class PaymentType
{
  const CASH               = 1;
  const VISA               = 2;
  const VISA_AFTER_DELIVER = 3;
  const CIB_VISA           = 4;
  const NBE_VISA           = 5;

  public static function getList()
  {
      return [
          self::CASH                => trans('front.cash'),
          self::VISA                => trans('front.visa'),
          self::VISA_AFTER_DELIVER  => trans('front.visa_after_deliver'),
          self::CIB_VISA            => trans('CIB VISA'),
          self::NBE_VISA            => trans('NBE VISA')
      ];
  }

  public static function getLabel($key)
  {
      return self::getList()[$key];
  }
}
