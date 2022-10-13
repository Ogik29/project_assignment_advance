<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\userService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(userService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $post = $this->userService->register($validateData);
        return $post;

        // $credentials = request(['name', 'email', 'password']);
        // $token = auth()->attempt($credentials);

        // if (!$token) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // if ($this->userService->register($validateData) == 1) {
        //     return response()->json([
        //         'access_token' => $token,
        //         'token_type' => 'bearer',
        //         'expires_in' => auth()->factory()->getTTL() * 60,
        //         'Successfully to Register'
        //     ]);
        // } else {
        //     'Failed to Register';
        // }
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function data()
    {
        return response()->json(auth()->user());
    }

    public function refresh()
    {
        return response()->json([
            'access_token' => auth()->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function get_user_post($user_id)
    {
        $user_name = $this->userService->get_user($user_id)->name;
        $user_post = $this->userService->get_user($user_id)->post;
        return response()->json([
            'Post of' => $user_name,
            'Posts' => $user_post
        ]);
    }
}
