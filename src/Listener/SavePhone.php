<?php

namespace  HamZone\AuthPhone\Listener;

use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;
use Flarum\Foundation\ValidationException;
use Illuminate\Contracts\Cache\Repository;

class SavePhone
{
    protected $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    public function handle(Saving $event)
    {
        $user = $event->user;
        $data = $event->data;
        $actor = $event->actor;

        $isSelf = $actor->id === $user->id;
        $canEdit = $actor->can('edit', $user);
        $attributes = Arr::get($data, 'attributes', []);

        if ( isset($attributes['phone']) ) {
            if (!$isSelf) {
                $actor->assertPermission($canEdit);
            }
            if ($attributes['phone']==""){
                throw new ValidationException(["Phone is invalid"]);
            }
            if(!isset($attributes['code']) || $attributes['code']==""){
                //Code is invalid
                throw new ValidationException(["请输入验证码"]);
            }

            $code = $this->cache->get($user->id."_".$attributes['phone']);
            if(!$code){
                //The verification code has expired or does not exist
                throw new ValidationException(["验证码已过期或不存在，请重新发送"]);
            }
            if($code!=$attributes['code']){
                throw new ValidationException(["验证码错误"]);
            }
            $this->cache->delete($user->id."_".$attributes['phone']);
            $this->cache->delete($attributes['phone']."_time");

            $user->phone = $attributes['phone'];

            $user->save();
        }
    }
}