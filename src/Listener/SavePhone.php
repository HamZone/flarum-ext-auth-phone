<?php

namespace  HamZone\AuthPhone\Listener;

use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;
use Flarum\Foundation\ValidationException;
use Illuminate\Contracts\Cache\Repository;
use HamZone\AuthPhone\PhoneHistory;

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
                PhoneHistory::insert([
                    "user_id" => $user->id,
                    "phone" => $user->phone,
                    "created_time" => time()
                ]);
                $user->phone = "";
                $user->save();
                return;
            }
            if(!isset($attributes['code']) || $attributes['code']==""){
                throw new ValidationException(["msg" => "code_null"]);
            }
            $code = $this->cache->get($user->id."_".$attributes['phone']);
            if(!$code){
                throw new ValidationException(["msg"=>"code_expired"]);
            }
            if($code!=$attributes['code']){
                throw new ValidationException(["msg"=>"code_invalid"]);
            }
            $this->cache->delete($user->id."_".$attributes['phone']);
            $this->cache->delete($attributes['phone']."_time");
            $user->phone = $attributes['phone'];
            $user->save();
        }
    }
}