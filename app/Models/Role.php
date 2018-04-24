<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public $timestamps = false;

    protected $fillable = ['name', 'weight'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles', 'role_id', 'user_id');
    }
}
