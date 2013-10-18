<?php

namespace spec\Core\Roar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FactorySpec extends ObjectBehavior
{
    function it_should_return_an_user()
    {
        $this->anUser('@aramirez_')->shouldHaveType('Core\Roar\User');
    }

    function it_should_return_an_in_memory_user_repository()
    {
        $this->anInMemoryUserRepository()->shouldHaveType('Core\Roar\UserInMemoryRepository');
    }

    /**
     * @param \MongoDB $connection
     */
    function it_should_return_a_mongodb_user_repository($connection)
    {
        $connection->selectCollection('user')->willReturn(null);
        $this->anUserMongoDBRepository($connection)->shouldHaveType('Core\Roar\UserMongoDBRepository');
    }

    function it_should_return_the_user_service()
    {
        $user_repository = $this->getWrappedObject()->anInMemoryUserRepository();
        $this->userService($user_repository)->shouldHaveType('Core\Roar\UserService');
    }
}
