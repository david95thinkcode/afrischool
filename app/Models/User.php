<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'username', 'active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function hasRole($role)
    {
        if ($role instanceof Model) $role = $role->getKey();

        if ($this->roles->isEmpty()) return false;

        return ($this->roles->contains('id', null, $role) || $this->roles->contains('name', null, $role));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id')
                    ->where('users_roles.is_active','=',true);
    }
}
