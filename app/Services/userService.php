<?php

namespace App\Services;

use App\Repositories\userRepository;
use MongoDB\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Validator;

class userService
{
    protected $userRepository;

    public function __construct(userRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($data)
    {
        $data['password'] = bcrypt($data['password']);

        return $this->userRepository->register($data);
    }

    public function get_user($id)
    {
        // if (auth()->user()->_id == $id) {
        //     return $this->userRepository->get_user($id);
        // } else {
        //     return "You Can't";
        // }

        return $this->userRepository->get_user($id);
    }
}
