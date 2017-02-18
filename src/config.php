<?php

define('ENABLE_HTTP_PROXY', env('ALIYUN_SMS_ENABLE_HTTP_PROXY', false));
define('HTTP_PROXY_IP',     env('ALIYUN_SMS_HTTP_PROXY_IP', '127.0.0.1'));
define('HTTP_PROXY_PORT',   env('ALIYUN_SMS_HTTP_PROXY_PORT', '8888'));

return [

    'region_id'         => env('ALIYUN_SMS_REGION_ID', 'cn-hangzhou'), // regionid

    'access_key'        => env('ALIYUN_SMS_AK'), // accessKey
    'access_secret'     => env('ALIYUN_SMS_AS'), // accessSecret
    'sign_name'         => env('ALIYUN_SMS_SIGN_NAME'), // 签名

];
