<?php

namespace HamZone\AuthPhone\Common;

use Exception;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use AlibabaCloud\Tea\Exception\TeaError;

use Darabonba\OpenApi\Models\Config;

use Flarum\Settings\SettingsRepositoryInterface;

class AliSMS 
{
    public static function createClient($accessKeyId, $accessKeySecret){
        $config = new Config([
            // 必填，您的 AccessKey ID
            "accessKeyId" => $accessKeyId,
            // 必填，您的 AccessKey Secret
            "accessKeySecret" => $accessKeySecret
        ]);
        // 访问的域名
        $config->endpoint = "dysmsapi.aliyuncs.com";
        return new Dysmsapi($config);
    }

    public static function send($phone, $code){
        $settings = app(SettingsRepositoryInterface::class);

        $client = self::createClient(
            $settings->get('flarum-ext-auth-phone.sms_ali_access_id'), 
            $settings->get('flarum-ext-auth-phone.sms_ali_access_sec')
        );
        $sendSmsRequest = new SendSmsRequest([
            "signName" => $settings->get('flarum-ext-auth-phone.sms_ali_sign'),
            "templateCode" => $settings->get('flarum-ext-auth-phone.sms_ali_template_code'),
            "phoneNumbers" => $phone,
            "templateParam" => "{\"code\":\"".$code."\"}"
        ]);
        try {
            // 复制代码运行请自行打印 API 的返回值
            $client->sendSmsWithOptions($sendSmsRequest, new RuntimeOptions([]));
        }
        catch (Exception $error) {
            if (!($error instanceof TeaError)) {
                $error = new TeaError([], $error->getMessage(), $error->getCode(), $error);
            }
            app('log')->error( $error->message );
        }
    }
}