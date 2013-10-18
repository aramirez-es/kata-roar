<?php

namespace Core\Roar;

class User
{
    private $username;
    private $following_collection = [];

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function follow(User $user_to_follow)
    {
        $this->following_collection[] = $user_to_follow;
    }

    public function getFollowings()
    {
        return $this->following_collection;
    }

    public function isEqualTo(User $other)
    {
        return $this->getUsername() === $other->getUsername();
    }
}
