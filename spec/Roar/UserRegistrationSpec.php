<?php

namespace spec\Roar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserRegistrationSpec extends ObjectBehavior
{
    function it_allows_registering_a_user_by_username()
    {
        $username = '@aramirez_';

        $this->register($username)->shouldBe(true);
    }
}
