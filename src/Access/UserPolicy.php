<?php

namespace HamZone\AuthPhone\Access;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;

class UserPolicy extends AbstractPolicy
{
    private $key = 'hamzone.phone';

    /**
     * @param User $actor
     * @param User $user
     *
     * @return bool|null
     */
    public function banIP(User $actor, User $user)
    {
        if ($user == null || $actor->id == $user->id || $user->can($this->key)) {
            return false;
        }

        return $actor->can($this->key);
    }
}
