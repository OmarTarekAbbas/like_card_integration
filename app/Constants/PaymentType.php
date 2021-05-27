<?php


namespace App\Constants;


final class PaymentType
{
  const NO_PAYMENT         = 0;
  const DCB                = 1;
  const MYFATOORAH         = 2;

  public static function getList()
  {
      return [
          self::NO_PAYMENT       => trans('no payment yet'),
          self::DCB              => trans('DCB'),
          self::MYFATOORAH       => trans('MyFatoorah'),
      ];
  }

  public static function getLabel($key)
  {
      return self::getList()[$key];
  }
}
