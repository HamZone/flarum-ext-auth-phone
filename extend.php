<?php

/*
 * This file is part of hamzone/flarum-ext-auth-phone.
 *
 * Copyright (c) 2022 Emin.lin(BG5UWQ).
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace HamZone\AuthPhone;

use Flarum\Extend;
use Flarum\Api\Serializer\ForumSerializer;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),


    (new Extend\Policy())
        ->modelPolicy(User::class, Access\UserPolicy::class),

    (new Extend\User())->permissionGroups(function ($actor, $groupIds) {
        return PermissionGroupProcessor::process($actor, $groupIds);
    }),

    (new Extend\ApiSerializer(ForumSerializer::class))
        ->attribute('canStartDiscussion', function (ForumSerializer $serializer) {
            return false;
        }),


];
