<?php


namespace App\Constants;


final class PaymentStatus
{
    const Pending = 0;
    const Success = 1;
    const Cancle  = 2;
    const Fail    = 3;

    public static function getList()
    {
        return [
            self::Pending  => trans('pending'),
            self::Success  => trans('success'),
            self::Cancle   => trans('cancle'),
            self::Fail     => trans('fail'),
        ];
    }

    public static function getLabel($key)
    {
        return self::getList()[$key];
    }
}
