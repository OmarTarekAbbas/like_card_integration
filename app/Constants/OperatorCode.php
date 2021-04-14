<?php


namespace App\Constants;


final class OperatorCode
{
  const ZAIN_KUWAIT         = 41902;
  const OOREDOO_KUWAIT      = 41903;
  const STC_KUWAIT          = 41904;

  public static function getList()
  {
      return [
          self::STC_KUWAIT       => trans('41902'),
          self::ZAIN_KUWAIT      => trans('41903'),
          self::OOREDOO_KUWAIT   => trans('41904'),
      ];
  }

  public static function getLabel($key)
  {
      return self::getList()[$key];
  }
}
