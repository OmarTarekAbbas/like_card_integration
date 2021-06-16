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
            self::PENDING        => trans('InProgress'),
            self::FINISHED       => trans('Succss'),
            self::CANCEL         => trans('Failed'),
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
