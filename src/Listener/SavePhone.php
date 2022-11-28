<?php

namespace  HamZone\AuthPhone\Listener;

use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;

class SavePhone
{
    public function handle(Saving $event)
    {
        $user = $event->user;
        $data = $event->data;
        $actor = $event->actor;

        $isSelf = $actor->id === $user->id;
        $canEdit = $actor->can('edit', $user);
        $attributes = Arr::get($data, 'attributes', []);

        if (isset($attributes['phone'])) {
            if (!$isSelf) {
                $actor->assertPermission($canEdit);
            }
            $user->phone = $attributes['phone'];
            $user->save();
        }
    }
}