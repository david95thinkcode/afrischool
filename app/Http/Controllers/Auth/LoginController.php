<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Flashy;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        flashy()->success('Bienvenu '.Auth::user()->name);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }


    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('parent'))
        {
            return Redirect::route('consultation.choix');
        }
        else
        {
            return Redirect::route('dashboard.home');
        }

    }

    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['active'] = true;

        return $credentials;
    }
}
