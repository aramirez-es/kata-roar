<?php

namespace Core\Roar;

class UserInMemoryRepository implements UserRepository
{
    private $users = [];

    public function add(User $user)
    {
        $this->users[$user->getUsername()] = $user;
    }

    public function exists($username)
    {
        return isset($this->users[$username]);
    }

    public function get($username)
    {
        if ($this->exists($username)) {
            return $this->users[$username];
        }

        return null;
    }
}
