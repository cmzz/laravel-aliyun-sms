<?php

namespace Cmzz\LaravelAliyunSms;

use Cmzz\AliyunCore\Profile\DefaultProfile;
use Cmzz\AliyunCore\DefaultAcsClient;
use Cmzz\AliyunSms\Sms\Request\V20160927\SingleSendSmsRequest;
use Cmzz\AliyunCore\Exception\ClientException;
use Cmzz\AliyunCore\Exception\ServerException;

class AliyunSms {

    public function send($mobile, $tplId, $params)
    {
        dd(config());

        $iClientProfile = DefaultProfile::getProfile(config('aliyunsms.region_id'), config('aliyunsms.access_key'), config('aliyunsms.access_secret'));
        $client = new DefaultAcsClient($iClientProfile);
        $request = new SingleSendSmsRequest();
        $request->setSignName(config('aliyunsms.sign_name')); /*签名名称*/
        $request->setTemplateCode($tplId);                /*模板code*/
        $request->setRecNum($mobile);                     /*目标手机号*/
        $request->setParamString(json_encode($params));/*模板变量，数字一定要转换为字符串*/

        try {
            $response = $client->getAcsResponse($request);
            print_r($response);
        } catch (ClientException  $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        } catch (ServerException  $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        }
    }

}