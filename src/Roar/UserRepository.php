<?php

namespace Roar;

class UserRepository
{
    private $users = [];

    public function add($user)
    {
        $this->users[] = $user;
    }

    public function exists($user)
    {
        return in_array($user, $this->users);
    }
}
