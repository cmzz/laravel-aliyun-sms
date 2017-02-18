# laravel-aliyun-sms

阿里云短信服务 for Laravel

## 安装

> composer require cmzz/laravel-aliyun-sms

## 使用

    $smsService = App::make(AliyunSms::class);
    $smsService->send(strval($mobile), 'SMS_xxx', ['code' => strval(1234), 'product' => 'xxx']);

## 配置

`.env` 配置中支持一下配置项:

    // aliyun sms
    ALIYUN_SMS_ENABLE_HTTP_PROXY=false
    ALIYUN_SMS_HTTP_PROXY_IP=127.0.0.1
    ALIYUN_SMS_HTTP_PROXY_PORT=8888
    ALIYUN_SMS_REGION_ID=cn-hangzhou
    ALIYUN_SMS_AK
    ALIYUN_SMS_AS
    ALIYUN_SMS_SIGN_NAME


### 欢迎 Star