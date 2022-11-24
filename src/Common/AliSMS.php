<?php

namespace HamZone\AuthPhone\Common;

use Exception;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use AlibabaCloud\Tea\Exception\TeaError;

use Darabonba\OpenApi\Models\Config;

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Cache\Repository;

use HamZone\AuthPhone\Common\GenerateCode;

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

    public static function send($data){
        $msg = ["status" => false , "msg" => ""];
        $phone = isset($data["phone"]) ? $data["phone"] : 0;
        if (!$phone){
            $msg["msg"] = "param is invalid";
            return $msg;
        }
        $generate = resolve(GenerateCode::class);
        $code = $generate->generate($phone);
        if ($code == 1){
            $msg["msg"] = "code_exist";
            return $msg;
        }
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
            $client->sendSmsWithOptions($sendSmsRequest, new RuntimeOptions([]));
            $msg["status"] = true;
            return $msg;
        }
        catch (Exception $error) {
            if (!($error instanceof TeaError)) {
                $error = new TeaError([], $error->getMessage(), $error->getCode(), $error);
            }
            app('log')->error( $error->message );
            $msg["msg"] = $error->message;
            return $msg;
        }
    }
}