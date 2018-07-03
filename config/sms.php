<?php

return [
	// HTTP ����ĳ�ʱʱ�䣨�룩
    'timeout' => 5.0,

    // Ĭ�Ϸ�������
    'default' => [
        // ���ص��ò��ԣ�Ĭ�ϣ�˳�����
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // Ĭ�Ͽ��õķ�������
        'gateways' => [
            'yunpian', 'aliyun', 'alidayu',
        ],
    ],
    // ���õ���������
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'yunpian' => [
            'api_key' => '824f0ff2f71cab52936axxxxxxxxxx',
        ],
        'aliyun' => [
            'access_key_id' => '',
            'access_key_secret' => '',
            'sign_name' => '',
        ],
        'alidayu' => [
            //...
        ],
    ],
];