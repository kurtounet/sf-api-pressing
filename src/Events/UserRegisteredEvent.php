<?php

namespace App\Events;

use App\Entity\User;

class UserRegisteredEvent
{
    public const NAME = 'user.registered';

    public function __construct(
        private User $user
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}