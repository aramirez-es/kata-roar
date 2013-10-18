<?php

namespace spec\Roar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Roar\Factory;

class UserSpec extends ObjectBehavior
{
    /**
     * @var \Roar\Factory
     */
    private $factory;

    function let()
    {
        $this->factory = new Factory();

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

    private function anUser($username)
    {
        return $this->factory->anUser($username);
    }
}
