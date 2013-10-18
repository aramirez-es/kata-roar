<?php

namespace Core\Roar;

class Factory
{
    public function anUser($username)
    {
        return new User($username);
    }

    public function anInMemoryUserRepository()
    {
        return new UserInMemoryRepository();
    }

    public function anUserMongoDBRepository(\MongoDB $connection)
    {
        return new UserMongoDBRepository($connection);
    }

    public function userService(UserRepository $user_repository)
    {
        return new UserService($user_repository);
    }
}
