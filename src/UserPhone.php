<?php

namespace HamZone\AuthPhone;

use Flarum\Database\AbstractModel;
use Flarum\User\User;

class UserPhone extends AbstractModel
{
    protected $table = 'fof_terms_policies';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_phone');
    }
}