<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jour extends Model
{
    protected $table = 'jours';
    public $timestamps = true;

    public function horaires()
    {
        return $this->hasMany('App\Models\Horaire');
    }
}
