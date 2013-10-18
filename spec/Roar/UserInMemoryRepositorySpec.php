<?php

namespace spec\Roar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserInMemoryRepositorySpec extends ObjectBehavior
{
    function it_adds_an_user()
    {
        $username = '@aramirez_';
        $user = new \Roar\User($username);

        $this->add($user);
        $this->exists($username)->shouldBe(true);
    }

    function it_returns_false_if_user_does_not_exist()
    {
        $username = '@user_that_does_not_exist';

        $this->exists($username)->shouldBe(false);
    }

    function it_get_an_user_previously_added()
    {
        $username = '@existing_username';
        $user = new \Roar\User($username);

        $this->add($user);
        $this->get($username)->shouldBe($user);
    }
}
