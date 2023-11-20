<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }


    public function store(Request $request)
    {
        $user = $this->userService->createUser($request->all());
        return response($this->userService->createToken($user), 201);
    }

    public function login(Request $request)
    {
        $user = $this->userService->login($request->all());
        return response($this->userService->createToken($user));
    }

    public function logout(Request $request)
    {
        $this->userService->logout(auth()->user());
        return response(['message' => __('Logged out successfully')]);
    }
}
