<?php

namespace spec\Roar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserRepositorySpec extends ObjectBehavior
{
    function it_adds_an_user()
    {
        $username = '@aramirez_';

        $this->add($username);
        $this->exists($username)->shouldBe(true);
    }

    function it_returns_false_if_user_does_not_exist()
    {
        $username = '@user_that_does_not_exist';

        $this->exists($username)->shouldBe(false);
    }
}
