<?php

namespace spec\Roar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserRegistrationSpec extends ObjectBehavior
{
    function it_allows_registering_a_user_by_username()
    {
        $username = '@aramirez_';

        $this->register($username);
        $this->userExists($username)->shouldBe(true);
    }

    function it_throw_an_exception_if_user_already_exists()
    {
        $username = '@aramirez_';

        $this->register($username);
        $this->shouldThrow('\InvalidArgumentException')->during('register', [$username]);
    }

    function it_should_says_user_does_not_exists_if_it_was_not_registered_before()
    {
        $username = '@aramirez_';

        $this->userExists($username)->shouldBe(false);
    }
}
