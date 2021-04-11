<?php


namespace App\Constants;


final class OrderStatus
{
    const START          = 0;
    const PENDING        = 1;
    const UNDER_SHIPPING = 2;
    const FINISHED       = 3;
    const NOT_AVAILABLE  = 4;

    public static function getList()
    {
        return [
            self::START          => trans('front.admin_status.start'),
            self::PENDING        => trans('front.admin_status.pending'),
            self::UNDER_SHIPPING => trans('front.admin_status.under_shipping'),
            self::FINISHED       => trans('Finished'),
            self::NOT_AVAILABLE  => trans('messages.Not_available'),
        ];
    }

    public static function getLabel($key)
    {
        return self::getList()[$key];
    }
}
