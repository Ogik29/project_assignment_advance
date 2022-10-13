<?php

namespace App\Repositories;

use App\Models\User;

class userRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($data)
    {
        return $this->user->create($data);
    }

    public function get_user($id)
    {
        return $this->user->find($id);
    }
}
