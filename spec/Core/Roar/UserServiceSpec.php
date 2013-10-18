<?php

namespace spec\Core\Roar;

use PhpSpec\ObjectBehavior;
use PhpSpec\Matcher\InlineMatcher;
use Core\Roar\Factory;

class UserServiceSpec extends ObjectBehavior
{
    function let()
    {
        $factory = new Factory();

        $this->beConstructedWith($factory->anInMemoryUserRepository());
    }

    function it_allows_registering_a_user_by_username()
    {
        $user = $this->anUser('@aramirez_');

        $this->register($user);
        $this->userExists($user)->shouldBe(true);
    }

    function it_throw_an_exception_if_user_already_exists()
    {
        $user = $this->anUser('@aramirez_');

        $this->register($user);
        $this->shouldThrow('\InvalidArgumentException')->during('register', [$user]);
    }

    function it_follows_other_users_and_list_all_followings()
    {
        $user = $this->anUser('@aramirez_');
        $following1 = $this->anUser('@fiunchinho');

        $this->register($user);
        $this->register($following1);

        $this->follow($user, $following1);
        $this->getFollowers($user)->shouldBeArray();
        $this->getFollowers($user)->shouldHaveValue($following1);
    }

    function it_should_return_no_followings_if_username_does_not_exist()
    {
        $this->getFollowers('@user_does_not_exist')->shouldReturn([]);
    }

    public function getMatchers()
    {
        return [
            'haveValue' => function($array_of_followings, $username) {
                foreach ($array_of_followings as $following) {
                    if ($following->getUsername() === $username) {
                        return true;
                    }
                }
                return false;
            },
        ];
    }

    private function anUser($username)
    {
        return $username;
    }
}
