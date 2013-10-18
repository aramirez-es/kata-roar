<?php

namespace Core\Roar;

class UserService
{
    private $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function register($username)
    {
        if ($this->userExists($username)) {
            throw new \InvalidArgumentException();
        }

        $this->user_repository->add(new User($username));
    }

    public function userExists($username)
    {
        return $this->user_repository->exists($username);
    }

    public function follow($username, $username_to_follow)
    {
        if ($this->userExists($username)) {
            $user       = $this->user_repository->get($username);
            $following  = $this->user_repository->get($username_to_follow);

            $user->follow($following);
        }
    }

    public function getFollowers($username)
    {
        if ($this->userExists($username)) {
            return $this->user_repository->get($username)->getFollowings();
        }

        return [];
    }
}
