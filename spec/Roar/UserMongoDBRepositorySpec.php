<?php

namespace spec\Roar;

use PhpSpec\ObjectBehavior;
use PhpSpec\Matcher\InlineMatcher;
use Prophecy\Argument;

class UserMongoDBRepositorySpec extends ObjectBehavior
{
    function let()
    {
        $mongodb_connection = new \Mongo();
        $database = $mongodb_connection->selectDB('roar');

        $this->beConstructedWith($database);
        $this->clear();
    }

    function letGo()
    {
        $this->clear();
    }

    function it_ensure_repository_methods()
    {
        $this->shouldHaveType('Roar\UserRepository');
    }

    function it_adds_an_user()
    {
        $username = '@aramirez_';
        $user = new \Roar\User($username);

        $this->add($user);
        $this->exists($username)->shouldReturn(true);
        $this->get($username)->shouldBeUser($user);
    }

    function it_returns_null_if_user_does_not_exist()
    {
        $username = '@aramirez_';

        $this->exists($username)->shouldBe(false);
    }

    public function getMatchers()
    {
        return [
            'beUser' => function(\Roar\User $user, \Roar\User $other) {
                return $user->isEqualTo($other);
            },
        ];
    }
}
