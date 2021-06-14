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
  const AMEX               = 6;
  const Benefit            = 7;
  const MADA               = 8;
  const UAE_Debit_Cards    = 9;
  const Qatar_Debit_Cards  = 10;
  const Apple_Pay          = 11;
  const STC_Pay            = 12;
  const Oman_Net           = 13;
  const Mobile_Wallet_Egypt= 14;


  public static function getList()
  {
      return [
          self::NO_PAYMENT         => trans('no payment yet'),
          self::DCB                => trans('DCB'),
          self::KNET               => trans('KNET'),
          self::VISA_MASTER        => trans('VISA/MASTER'),
          self::Sadad              => trans('Sadad'),
          self::Meeza              => trans('Meeza'),
          self::AMEX               => trans('AMEX'),
          self::Benefit            => trans('Benefit'),
          self::MADA               => trans('MADA'),
          self::UAE_Debit_Cards    => trans('UAE Debit Cards'),
          self::Qatar_Debit_Cards  => trans('Qatar Debit Cards'),
          self::Apple_Pay          => trans('Apple Pay'),
          self::STC_Pay            => trans('STC Pay'),
          self::Oman_Net           => trans('Oman Net'),
          self::Mobile_Wallet_Egypt=> trans('Mobile Wallet (Egypt)'),
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
