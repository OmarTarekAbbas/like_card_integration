<?php


namespace App\Constants;


final class PaymentType
{
  static const NO_PAYMENT         = 0;
  static const DCB                = 1;
  static const KNET               = 2;
  static const VISA_MASTER        = 3;
  static const Sadad              = 4;
  static const Meeza              = 5;

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
}
