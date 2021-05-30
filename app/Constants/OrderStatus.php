<?php


namespace App\Constants;


final class OrderStatus
{
    const PENDING        = 0;
    const FINISHED       = 1;
    const CANCEL         = 2;

    public static function getList()
    {
        return [
            self::PENDING        => trans('Pending'),
            self::FINISHED       => trans('Paid'),
            self::CANCEL         => trans('Canceled'),
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
