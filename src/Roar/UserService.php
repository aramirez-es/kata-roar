<?php

namespace Roar;

class UserService
{
    private $user_repository;
    private $following_graph = [];

    public function __construct($user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function register($user)
    {
        if ($this->userExists($user)) {
            throw new \InvalidArgumentException();
        }

        $this->user_repository->add($user);
    }

    public function userExists($user)
    {
        return $this->user_repository->exists($user);
    }

    public function getFollowers($user)
    {
        if (isset($this->following_graph[$user])) {
            return $this->following_graph[$user];
        }

        return [];
    }

    public function follow($user, $user_to_follow)
    {
        if (!isset($this->following_graph[$user])) {
            $this->following_graph[$user] = [];
        }

        $this->following_graph[$user][] = $user_to_follow;
    }
}
