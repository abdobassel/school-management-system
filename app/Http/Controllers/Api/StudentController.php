<?php

namespace App\Http\Controllers\Api;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudent;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\UserServices;

class StudentController extends Controller
{



    public function login(Request $request)
    {
        $loginStudentData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:4'
        ]);
        $student = Student::where('email', $loginStudentData['email'])->first();
        if (!$student || !Hash::check($loginStudentData['password'], $student->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
        $token = $student->createToken($student->name . '-AuthToken')->plainTextToken;
        if ($token) {
            return response()->json([
                'student' => $student->grade->name,
                'access_token' => $token,

            ]);
        } else {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
    }
    ///
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "logged out"
        ]);
    }
}
