<?php

namespace HamZone\AuthPhone\Common;
use Flarum\User\User;

class Blind 
{
    public static function smsAuth(User $actor, $data)
    {
        $msg = ["status" => false , "msg" => ""];
        $phone = isset($data["phone"]) ? $data["phone"] : 0;
        $code = isset($data["code"]) ? $data["code"] : 0;
        if (!$phone || !$code){
            $msg["msg"] = "param is invalid";
            return $msg;
        }
        $exists = $actor->userPhone()->where('id', 1)->exists();
    }
}