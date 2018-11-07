<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TeamLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.team.login');
    }

    public function showRegisterForm()
    {
        return view('auth.team.register');
    }

    public function registerTeam(TeamRequest $request)
    {
        $validate = $request->validated();
        $validate['verified'] = true;
        Team::create($validate);
        Session::flash('status', 'Registration Successful');
        return redirect()->route('login');
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
