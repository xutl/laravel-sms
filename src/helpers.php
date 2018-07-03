<?php

use Overtrue\EasySms\EasySms;

if (!function_exists('sms')){
    /**
     * @return EasySms
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