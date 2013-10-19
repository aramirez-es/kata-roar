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

    public function userService()
    {
        return new UserService(new UserInMemoryRepository());
    }

    public function userServicePersistent(\MongoDB $connection)
    {
        return new UserService(new UserMongoDBRepository($connection));
    }
}
