<?php

namespace spec\Core\Roar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Core\Roar\Factory;

class UserInMemoryRepositorySpec extends ObjectBehavior
{
    /**
     * @var \Core\Roar\Factory
     */
    private $factory;

    function let()
    {
        $this->factory = new Factory();
    }

    function it_ensure_repository_methods()
    {
        $this->shouldHaveType('Core\Roar\UserRepository');
    }

    function it_adds_an_user()
    {
        $username = '@aramirez_';
        $user = $this->anUser($username);

        $this->add($user);
        $this->exists($username)->shouldBe(true);
    }

    function it_returns_false_if_user_does_not_exist()
    {
        $username = '@user_that_does_not_exist';

        $this->exists($username)->shouldBe(false);
    }

    function it_get_an_user_with_followings_previously_added()
    {
        $username = '@existing_username';
        $user = $this->anUser($username);
        $user->follow($this->anUser('@cool_user'));

        $this->add($user);
        $this->get($username)->shouldBe($user);
    }

    private function anUser($username)
    {
        return $this->factory->anUser($username);
    }
}
