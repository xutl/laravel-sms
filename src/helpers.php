<?php

use Overtrue\EasySms\EasySms;

if (!function_exists('sms')){
    /**
     * @return array|EasySms
     * @throws \Overtrue\EasySms\Exceptions\InvalidArgumentException
     * @throws \Overtrue\EasySms\Exceptions\NoGatewayAvailableException
     */
    function sms(){
        $arguments = func_get_args();
        $easySms = app(EasySms::class);
        if (empty($arguments)) {
            return $easySms;
        }
        return $easySms->send($arguments[0],$arguments[1]);
    }
}