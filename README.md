# laravel-sms

This is a sms expansion for the laravel

## 平台支持

- [阿里云](https://www.aliyun.com/)
- [云片](https://www.yunpian.com)
- [Submail](https://www.mysubmail.com)
- [螺丝帽](https://luosimao.com/)
- [容联云通讯](http://www.yuntongxun.com)
- [互亿无线](http://www.ihuyi.com)
- [聚合数据](https://www.juhe.cn)
- [SendCloud](http://www.sendcloud.net/)
- [百度云](https://cloud.baidu.com/)
- [华信短信平台](http://www.ipyy.com/)
- [253云通讯（创蓝）](https://www.253.com/)
- [融云](http://www.rongcloud.cn)
- [天毅无线](http://www.85hu.com/)
- [腾讯云 SMS](https://cloud.tencent.com/product/sms)
- [阿里大于](https://www.alidayu.com/)(不推荐使用，请使用阿里云)
- [阿凡达数据](http://www.avatardata.cn/)

## 环境需求

- PHP >= 5.6

## Installation

```bash
composer require xutl/laravel-sms
```

## for Laravel

This service provider must be registered.

```php
// config/app.php

'providers' => [
    '...',
    XuTL\Sms\SmsServiceProvider::class,
];
```

add the config file: config/sms.php

add config

```php
use Overtrue\EasySms\Strategies\OrderStrategy;

return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    /*
    |--------------------------------------------------------------------------
    | Default Setting
    |--------------------------------------------------------------------------
    |
    | This option defines the default sms gateway that gets used when writing
    | messages to the sms. The name specified in this option should match
    | one of the gateways defined in the "gateways" configuration array.
    |
    */
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => OrderStrategy::class,

        /*
        |--------------------------------------------------------------------------
        | Default Gateways
        |--------------------------------------------------------------------------
        |
        | This option defines the default sms gateway that gets used when writing
        | messages to the sms. The name specified in this option should match
        | one of the gateways defined in the "gateways" configuration array.
        |
        */
        'gateways' => [

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Gateways
    |--------------------------------------------------------------------------
    |
    | Here you may configure the sms gateways for your application.  This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "aliyun", "alidayu", "yunpian", "submail",
    |                    "errorlog", "luosimao", "yuntongxun", "huyi"
    |                    "juhe", "sendcloud", "baidu", "huaxin", "chuanglan"
    |                    "rongcloud", "tianyiwuxian", "twilio", "qcloud", "avatardata"
    |
    */
    'gateways' => [
        //Doc
        // https://github.com/overtrue/easy-sms
    ],
];
```


## Use

```php
try {
    $res = sms('13800138000', ['content'  => '您的验证码为: 6379','template' => '259734', 'data' => [6379]]);
    print_r($res);
} catch (InvalidArgumentException $e) {
    print_r($e->getMessage());
} catch (NoGatewayAvailableException $e) {
    print_r($e->getMessage());
}
```