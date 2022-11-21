<?php

namespace HamZone\AuthPhone\Common;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use Darabonba\OpenApi\Models\Config;

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

    public static function send($args){
        // 初始化 Client，采用 AK&SK 鉴权访问的方式，此方式可能会存在泄漏风险，建议使用 STS 方式。鉴权访问方式请参考：https://help.aliyun.com/document_detail/311677.html
        // 获取 AK 链接：https://usercenter.console.aliyun.com
        $client = self::createClient("accessKeyId", "accessKeySecret");
        $sendSmsRequest = new SendSmsRequest([
            "signName" => "your_value",
            "templateCode" => 1,
            "phoneNumbers" => "your_value",
            "templateParam" => "your_value"
        ]);
        // try {
            // 复制代码运行请自行打印 API 的返回值
            $client->sendSmsWithOptions($sendSmsRequest, new RuntimeOptions([]));
        // }
        // catch (Exception $error) {
        //     if (!($error instanceof TeaError)) {
        //         $error = new TeaError([], $error->getMessage(), $error->getCode(), $error);
        //     }
        //     // 如有需要，请打印 error
        //     Utils::assertAsString($error->message);
        // }
    }
}