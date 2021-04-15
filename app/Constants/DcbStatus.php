<?php


namespace App\Constants;


final class DcbStatus
{
    const Pending                        = 0;
    const Unknown                        = 10101;
    const Invalid_IP                     = 10102;
    const Invalid_Username_And_Password  = 10103;
    const Invalid_Operator_ID            = 10104;
    const Invalid_Request_ID             = 10105;
    const Invalid_Channel_ID             = 10106;
    const Invalid_MSISDN_ID              = 10107;
    const Invalid_Live_Backup            = 10402;
    const Invalid_Price                  = 10403;
    const Invalid_Pin_Code               = 10501;
    const Invalid_SDP_Pin_Code           = 10502;
    const Blacklisted_Number             = 10504;
    const Billing_Failed                 = 10505;

    public static function getList()
    {
        return [
            self::Pending                         => trans('Pending'),
            self::Unknown                         => trans('there are unknown error'),
            self::Invalid_IP                      => trans('Invalid_IP'),
            self::Invalid_Username_And_Password   => trans('Invalid_Username_And_Password'),
            self::Invalid_Operator_ID             => trans('Invalid_Operator_ID'),
            self::Invalid_Request_ID              => trans('Invalid_Request_ID'),
            self::Invalid_Channel_ID              => trans('Invalid_Channel_ID'),
            self::Invalid_Live_Backup             => trans('Invalid_Live_Backup'),
            self::Invalid_Price                   => trans('Invalid_Price'),
            self::Invalid_Pin_Code                => trans('Invalid_Pin_Code'),
            self::Invalid_SDP_Pin_Code            => trans('Invalid_SDP_Pin_Code'),
            self::Blacklisted_Number              => trans('Blacklisted_Number'),
            self::Billing_Failed                  => trans("you don't have sufficient funds"),
        ];
    }

    /**
     * Method getLabel
     *
     * @param int $key
     *
     * @return string
     */
    public static function getLabel($key)
    {
        return in_array($key, array_keys(self::getList())) ? self::getList()[$key] : self::getList()[self::Unknown];
    }
}
