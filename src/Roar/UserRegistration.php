<?php

namespace Roar;

class UserRegistration
{
    private $users = [];

    public function register($user)
    {
        if ($this->userExists($user)) {
            throw new \InvalidArgumentException();
        }

        $this->users[] = $user;
    }

    public function userExists($user)
    {
        return in_array($user, $this->users);
    }
}
