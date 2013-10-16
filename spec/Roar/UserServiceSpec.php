<?php

namespace spec\Roar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserServiceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new \Roar\UserRepository());
    }

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

    function it_should_follow_other_users()
    {
        $username = '@aramirez_';

        $this->follow($username, '@fiunchinho');
        $this->follow($username, '@pasku1');
        $this->follow($username, '@jacegu');

        $this->getFollowers($username)->shouldReturn(['@fiunchinho', '@pasku1', '@jacegu']);
    }
}
