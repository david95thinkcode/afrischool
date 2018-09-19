<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'users_roles';

    protected $fillable = [
        'user_id', 'role_id', 'desactivation_date', 'is_active'
    ];

    public $timestamps = true;
}
