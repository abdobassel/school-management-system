<?php

namespace App\Http\Controllers\Api;

use App\Teacher;
use App\Teachercher;
use Illuminate\Http\Request;
use Illuminate\Http\Requestuest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controllerller;
use Illuminate\Support\Facades\HashHash;

class TeacherController extends Controller
{
    public function login(Request $request)
    {
        $loginTeacherData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:4'
        ]);

        $teacher = Teacher::where('email', $loginTeacherData['email'])->first();
        if (!$teacher || !Hash::check($loginTeacherData['password'], $teacher->password)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        $token = $teacher->createToken('teacherToken', ['teacher'])->plainTextToken;

        return response()->json([
            'user' => $teacher,
            'user_type' => 'teacher',
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logged out']);
    }
}
