<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeamLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.team.login');
    }

    protected function guard()
    {
        return Auth::guard('team');
    }

    use AuthenticatesUsers;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest:team')->except('logout');
    }

}
