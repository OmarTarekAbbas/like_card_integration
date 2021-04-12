<?php


namespace App\Constants;


final class OrderStatus
{
    const PENDING        = 0;
    const FINISHED       = 1;
    const FAIL           = 2;

    public static function getList()
    {
        return [
            self::PENDING        => trans('Pending'),
            self::FINISHED       => trans('Finished'),
            self::FAIL           => trans('Fail'),
        ];
    }

    public static function getLabel($key)
    {
        return self::getList()[$key];
    }
}
