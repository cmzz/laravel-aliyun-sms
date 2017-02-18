<?php

namespace Cmzz\LaravelAliyunSms;

use Cmzz\AliyunCore\Profile\DefaultProfile;
use Cmzz\AliyunCore\DefaultAcsClient;
use Cmzz\AliyunCore\Regions\Endpoint;
use Cmzz\AliyunCore\Regions\EndpointConfig;
use Cmzz\AliyunCore\Regions\EndpointProvider;
use Cmzz\AliyunSms\Sms\Request\V20160927\SingleSendSmsRequest;
use Cmzz\AliyunCore\Exception\ClientException;
use Cmzz\AliyunCore\Exception\ServerException;

class AliyunSms {

    public function send($mobile, $tplId, $params)
    {
        define('ENABLE_HTTP_PROXY', env('ALIYUN_SMS_ENABLE_HTTP_PROXY', false));
        define('HTTP_PROXY_IP',     env('ALIYUN_SMS_HTTP_PROXY_IP', '127.0.0.1'));
        define('HTTP_PROXY_PORT',   env('ALIYUN_SMS_HTTP_PROXY_PORT', '8888'));

        $endpoint = new Endpoint(config('aliyunsms.region_id'), EndpointConfig::getregionIds(), EndpointConfig::getProducDomains());
        $endpoints = array($endpoint);
        EndpointProvider::setEndpoints($endpoints);

        $iClientProfile = DefaultProfile::getProfile(config('aliyunsms.region_id'), config('aliyunsms.access_key'), config('aliyunsms.access_secret'));
        $client = new DefaultAcsClient($iClientProfile);
        $request = new SingleSendSmsRequest();
        $request->setSignName(config('aliyunsms.sign_name')); /*签名名称*/
        $request->setTemplateCode($tplId);                /*模板code*/
        $request->setRecNum($mobile);                     /*目标手机号*/
        $request->setParamString(json_encode($params));/*模板变量，数字一定要转换为字符串*/

        try {
            $response = $client->getAcsResponse($request);
            return $response;
        } catch (ClientException  $e) {
            logger()->error('客户端错误');
            logger()->error($e->getErrorCode());
            logger()->error($e->getErrorMessage());
            throw new ClientException($e);
        } catch (ServerException  $e) {
            logger()->error('服务端错误');
            logger()->error($e->getErrorCode());
            logger()->error($e->getErrorMessage());

        }

        return false;
    }

}