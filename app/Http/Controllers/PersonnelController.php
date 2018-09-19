<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flashy;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePersonnelRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserRole;
use App\Http\Requests\AddRoleToUserRequest;
use App\Http\Requests\ActivateUserRoleRequest;

class PersonnelController extends Controller
{
    static $roles = [
        'fon'   =>  'fondateur',
        'dir'   =>  'directeur',
        'cen'   =>  'censeur',
        'com'   =>  'comptable',
        'sur'   =>  'surveillant',
        'sec'   =>  'secretaire',
        'par'   =>  'parent',
        'admin' =>  'administrator',
        'auth'  =>  'authenticated'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Retourne la liste du personnel
     *
     * @return void
     */
    public function index()
    {        
        $users = User::all();
        // TODO: afficher les users dont les users_roles sont activés
        return view('dashboard.personnel.index', compact('users'));
    }

    /**
     * permet d'afficher la vue pour créer un compte utilisateur
     * du personnel de l'école
     *
     * @return void
     */
    public function create()
    {
        $roles = null;
        
        /**
         * Un admin peut créer tous les types de comptes utilisateur
         * 
         * Un fondateur peut créer tout sauf adminstrateur, parent et administrator
         * 
         * Un censeur peut créer :
         * - un autre censeur
         * - une secretaire
         * - un surveillant
         * 
         * Le reste des utilisateurs ne peut créer qu'un compte 
         * de même niveau que le sien, mais aussi une secrétaire
         */

        if (Auth::user()->hasRole(self::$roles['admin']))
        {
            $roles = Role::all();
        }
        elseif (Auth::user()->hasRole(self::$roles['fon']))
        {
            $roles = Role::where('name', '<>', self::$roles['admin'])
                ->where('name', '<>', self::$roles['auth'])
                ->where('name', '<>', self::$roles['par'])
                ->get();
        }
        elseif (Auth::user()->hasRole(self::$roles['cen']))
        {
            $roles = Role::where('name', 'like', self::$roles['cen'])
                ->orWhere('name', 'like', self::$roles['sec'])
                ->orWhere('name', 'like', self::$roles['sur'])
                ->get();
        }
        else
        {
            $roles = Role::where('name', Auth::user()->roles[0]->name)
                ->orWhere('name', self::$roles['sec'])
                ->get();
        }

        return view('dashboard.personnel.create', compact('roles'));
    }

    /**
     * Retourne la vue pour ajouter un role à un utilisateur
     *
     * @return void
     */
    public function createUserRole()
    {

        $users = User::where('id', '<>', Auth::user()->id)->get();
        $roles = null;

        if (Auth::user()->hasRole(self::$roles['admin']))
        {
            $roles = Role::all();
        }
        elseif (Auth::user()->hasRole(self::$roles['fon']))
        {
            $roles = Role::where('name', '<>', self::$roles['admin'])
                ->where('name', '<>', self::$roles['auth'])
                ->where('name', '<>', self::$roles['par'])
                ->get();
        }
        elseif (Auth::user()->hasRole(self::$roles['cen']))
        {
            $roles = Role::where('name', 'like', self::$roles['cen'])
                ->orWhere('name', 'like', self::$roles['sec'])
                ->orWhere('name', 'like', self::$roles['sur'])
                ->get();
        }
        else
        {
            $roles = Role::where('name', Auth::user()->roles[0]->name)
                ->orWhere('name', self::$roles['sec'])
                ->get();
        }

        return view('dashboard.personnel.add-role', compact('roles', 'users'));
    }


    public function store(StorePersonnelRequest $req)
    {
        $u = new User();
        $u->name = $req->name;
        $u->email = $req->email;
        $u->username = $req->email;
        $u->password = bcrypt($req->pwd);
        $u->active = true;
        $u->save();
        
        $this->storeUserRole($u->id, $req->role, null);

        Flashy::success('Ce compte a été créé avec succès');
        
        return Redirect::route('personnel.index');
    }

    /**
     * Enregistre une nouvelle occurance du model UserRole
     * dans la base de données si elle n'existe pas
     * Si ce role est existant pour ce user, 
     * mettre à jour le tuple dans la bdd
     */
    public function addRoletoUser(AddRoleToUserRequest $req)
    {        
        $u = UserRole::where([
            ['user_id', $req->user],
            ['role_id', $req->role],
        ])->first();

        if (!is_null($u)) {
            UserRole::where([
                ['user_id', $req->user],
                ['role_id', $req->role]
            ])
            ->update([
                'desactivation_date' => $req->disableDate,
                'updated_by' => Auth::user()->id,
                'is_active' => true,
            ]);
        } else {
            $this->storeUserRole($req->user, $req->role, $req->disableDate);
        }

        Flashy::success('Enregistré avec succès !');
        
        return Redirect::route('personnel.index');
    }

    /**
     * Désactive le compte d'un utilisateur
     * jusqu'à une date donnée
     *
     * @param [type] $userId
     * @return void
     */
    public function disableUser($userId, $activationDate)
    {
        // TODO
    }

    // PRIVATE FUNCTIONS
    private function storeUserRole($userID, $roleID, $desactivationDate)
    {
        $userRole = new UserRole();
        $userRole->user_id = $userID;
        $userRole->role_id = $roleID;
        $userRole->desactivation_date = $desactivationDate;
        $userRole->created_by = Auth::user()->id;
        $userRole->is_active = true;
        $userRole->save();
    
        return $userRole;
    }
}
