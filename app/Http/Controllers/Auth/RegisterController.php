<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserRole;
use Flashy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/consultation';

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

        $user = User::create([
            'name' => $req->name,
            'username' => $req->username,
            'email' => $req->email,
            'active' => true,
            'password' => bcrypt($req->password),
        ]);

        UserRole::create([
            'user_id' =>$user->id,
            'role_id' => 2,
            'is_active' => true
        ]);

        Flashy::success('Votre compte a été créé avec succès');
        return redirect()->route('login');
    }
}
