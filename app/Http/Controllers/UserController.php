<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Flashy;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        $roles = Role::get();

        return view('dashboard.users.index', compact('users', 'roles'));
    }
    
    public function show(User $user)
    {
        return view('dashboard.users.show', ['user' => $user]);
    }

    public function activateOrDeactivate($user)
    {
        $u = User::findOrFail($user);
        $u->active = !$u->active;
        $u->save();

        Flashy::success("Effectué avec succès.");
        return back();
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', ['user' => $user, 'roles' => Role::get()]);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'active' => 'sometimes|boolean',
            'confirmed' => 'sometimes|boolean',
        ]);

        $validator->sometimes('email', 'unique:users', function ($input) use ($user) {
            return strtolower($input->email) != strtolower($user->email);
        });

        $validator->sometimes('password', 'min:6|confirmed', function ($input) {
            return $input->password;
        });

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors());

        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->has('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->active = $request->get('active', 0);
        $user->confirmed = $request->get('confirmed', 0);

        $user->save();

        //roles
        if ($request->has('roles')) {
            $user->roles()->detach();

            if ($request->get('roles')) {
                $user->roles()->attach($request->get('roles'));
            }
        }

        return redirect()->intended(route('dashboard.users'));
    }
}
