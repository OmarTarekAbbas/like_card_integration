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
          self::STC_KUWAIT       => 'STC Kuwait',
          self::ZAIN_KUWAIT      => 'ZAIN Kuwait',
          self::OOREDOO_KUWAIT   => 'OOREDOO Kuwait',
      ];
  }

  public static function getLabel($key)
  {
      return self::getList()[$key];
  }
}
