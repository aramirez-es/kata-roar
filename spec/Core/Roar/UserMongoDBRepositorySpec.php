<?php

namespace spec\Core\Roar;

use PhpSpec\ObjectBehavior;
use PhpSpec\Matcher\InlineMatcher;
use Prophecy\Argument;
use Core\Roar\Factory;
use Core\Roar\User;

class UserMongoDBRepositorySpec extends ObjectBehavior
{
    function let()
    {
        // Don't blame me for using Mongo instead MongoClient :-)
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
        $this->shouldHaveType('Core\Roar\UserRepository');
    }

    function it_adds_an_user()
    {
        $factory = new Factory();
        $username = '@aramirez_';
        $user = $factory->anUser($username);

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
            'beUser' => function(User $user, User $other) {
                return $user->isEqualTo($other);
            },
        ];
    }
}
