<?php


namespace App\Constants;


final class PaymentType
{
  const NO_PAYMENT         = 0;
  const DCB                = 1;
  const KNET               = 2;
  const VISA_MASTER        = 3;
  const Sadad              = 4;
  const Meeza              = 5;

  public static function getList()
  {
      return [
          self::NO_PAYMENT       => trans('no payment yet'),
          self::DCB              => trans('DCB'),
          self::KNET             => trans('KNET'),
          self::VISA_MASTER      => trans('VISA/MASTER'),
          self::Sadad            => trans('Sadad'),
          self::Meeza            => trans('Meeza'),
      ];
  }

  public static function getLabel($key)
  {
      return self::getList()[$key];
  }

  public static function getKey($label)
  {
      return array_search($label, array_values(self::getList()));
  }
}
