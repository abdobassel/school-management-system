<?php


namespace App\Http\Controllers\Api;

use App\MyParent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    public function login(Request $request)
    {
        $loginParentData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:4'
        ]);

        $parent = MyParent::where('email', $loginParentData['email'])->first();
        if (!$parent || !Hash::check($loginParentData['password'], $parent->password)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        $token = $parent->createToken('parentToken', ['parent'])->plainTextToken;

        return response()->json([
            'user' => $parent,
            'user_type' => 'parent',
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logged out']);
    }
}
