<?php

namespace Core\Roar;

interface UserRepository
{
    public function add(User $user);
    public function exists($username);
    public function get($username);
}
