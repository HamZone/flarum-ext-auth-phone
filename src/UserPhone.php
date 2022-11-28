<?php

namespace HamZone\AuthPhone;

use Flarum\Database\AbstractModel;
use Flarum\User\User;

class UserPhone extends AbstractModel
{
    protected $table = 'user_phone';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}