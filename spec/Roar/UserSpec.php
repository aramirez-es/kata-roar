<?php

namespace spec\Roar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('@aramirez_');
    }

    function it_gets_the_username_which_it_was_constructed_with()
    {
        $this->getUsername()->shouldReturn('@aramirez_');
    }

    function it_should_follow_other_users()
    {
        $user1 = $this->anUser('@fiunchinho');
        $user2 = $this->anUser('@pasku1');
        $user3 = $this->anUser('@jacegu');

        $this->follow($user1);
        $this->follow($user2);
        $this->follow($user3);

        $this->getFollowings()->shouldReturn([$user1, $user2, $user3]);
    }

    function it_can_be_converted_to_string()
    {
        $this->__toString()->shouldBeString();
    }

    private function anUser($username)
    {
        return new \Roar\User($username);
    }
}
