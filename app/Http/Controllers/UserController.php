<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|alpha_num|min:3'
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return view('welcome');
        }
        return view('login')->withErrors('Blogi prisijungimo duomenys');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('home');
    }
}
