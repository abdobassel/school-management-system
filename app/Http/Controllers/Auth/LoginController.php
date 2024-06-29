<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $email = $request->email;
        $password = $request->password;
        $guardType = '';
        if ($request->type == 'student') {
            $guardType = 'student';
        } elseif ($request->type == 'teacher') {
            $guardType = 'teacher';
        } elseif ($request->type == 'parent') {
            $guardType = 'parent';
        } else {
            $guardType = 'web';
        }


        if (auth()->guard($guardType)->attempt(['email' => $email, 'password' => $password])) {
            if ($guardType == 'student') {
                return redirect()->intended(RouteServiceProvider::STUDENT);
            } elseif ($guardType == 'teacher') {
                return redirect()->intended(RouteServiceProvider::TEACHER);
            } elseif ($guardType == 'parent') {
                return redirect()->intended(RouteServiceProvider::PARENT);
            } else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
    }


    public function loginForm($type)
    {
        return view('auth.login', compact('type'));
    }

    public function logout(Request $request, $type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
