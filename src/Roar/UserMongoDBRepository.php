<?php

namespace Roar;

class UserMongoDBRepository implements UserRepository
{
    const COLLECTION_NAME = 'user';

    private $collection;

    public function __construct(\MongoDB $connection)
    {
        $this->collection = $connection->selectCollection(self::COLLECTION_NAME);
    }

    public function add(User $user)
    {
        $this->collection->insert([
            'username' => $user->getUsername(),
            'followings' => $user->getFollowings()
        ]);
    }

    public function exists($username)
    {
        return (bool) $this->collection->count(['username' => $username]);
    }

    public function get($username)
    {
        $user = $this->collection->findOne(['username' => $username]);

        if ($user) {
            $user = new User($user['username']);
        }

        return $user;
    }

    public function clear()
    {
        $this->collection->drop();
    }
}
