<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserRole;
use Flashy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\StoreUserRequest;
use App\Models\Inscription;
use App\Models\ParentEleve;

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

    protected function create(StoreUserRequest $req)
    {
        // Roméo code
        /*
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
        
        */

        if ($this->isConfirmable($req->secret_code, $req->tel)) {

            $concernedParent = ParentEleve::where('par_tel', $req->tel)->first();
            $user = User::create([
                'name' => $concernedParent->full_name,
                'username' => $req->tel,
                'active' => false,
                'password' => bcrypt($req->password),
            ]);
            
            $concernedParent->user_id = $user->id;
            $concernedParent->save();

            Flashy::success('Votre compte a été créé avec succès');
            return redirect()->route('login');
        }
        else {
            Flashy::error("Informations d'inscription non valides");
            return back();
        }

    }

    private function isConfirmable($idInscription, $parentTel)
    {
        $idInscription = (int) $idInscription;
        $parentTel = (string) $parentTel;

        $i = Inscription::with('eleve')->where('id', $idInscription)->first();

        if (!is_null($i)) {
            $p = $i->eleve->parent->par_tel;
            return ($p == $parentTel) ? true : false;
        }
        
        return false;
    }
}
