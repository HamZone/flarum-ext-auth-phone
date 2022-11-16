<?php

namespace HamZone\AuthPhone;

use Flarum\Group\Group;
use Flarum\User\User;

class PermissionGroupProcessor
{
    public static function process(User $actor, array $groupIds): array
    {
        if ($actor->isGuest()) {
            return $groupIds;
        }

        $groupIds = [Group::GUEST_ID];

        return $groupIds;
    }

}