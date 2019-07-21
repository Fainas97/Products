<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->middleware('auth', ['except' => ['create', 'login']]);
        $this->user = $user;
    }

    public function create(Request $request)
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/');
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withErrors([
                'error' => 'Username or password is invalid.',
            ]);
    }
}
