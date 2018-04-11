<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Flashy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function create(Request $req)
    {
        $this->validate($req, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $req->name,
            'username' => $req->username,
            'email' => $req->email,
            'active' => false,
            'password' => bcrypt($req->password),
        ]);

        Flashy::success('Votre compte sera bientôt activé par l\'administrateur');
        return redirect()->route('login');
    }
}
