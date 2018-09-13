<?php

use XuTL\Sms\Sms;

if (!function_exists('sms')){
    /**
     * @return array|Sms
     * @throws \Overtrue\EasySms\Exceptions\InvalidArgumentException
     * @throws \Overtrue\EasySms\Exceptions\NoGatewayAvailableException
     */
    function sms(){
        $arguments = func_get_args();
        $sms = app(Sms::class);
        if (empty($arguments)) {
            return $sms;
        }
        return $sms->send($arguments[0],$arguments[1]);
    }
}