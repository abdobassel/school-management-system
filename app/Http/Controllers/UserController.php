<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Http\Controllers\Auth\UserServices;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private UserServices $userServices;
    const TOKEN_NAME = 'personal';
    public function __construct(UserServices $userService)
    {
        $this->userServices = $userService;
    }
    public function register(CreateUser $request)
    {
        $user =  $this->userServices->createUser($request);

        if ($user) {
            return response()->json([
                'user' => $user,
                'token' => $user->createToken(name: self::TOKEN_NAME)->plainTextToken, //token as text and  returns in response
            ]);
        }
    }
    public function login(Request $request)
    {
        return $this->userServices->login($request);
    }
    public function logout(Request $request)
    {
        return $this->userServices->logout($request);
    }
}
