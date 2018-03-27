<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = "classes";

    public $timestamps = true;

    /**
     * Pour une classe, il y a plusieurs inscription
     */
    public function inscriptions()
    {
        return $this->hasMany('App\Models\Inscription');
    }

    /**
     * Pour une classe il y a plusieurs coefficier
     */
    public function coefficients()
    {
        return $this->hasMany('App\Models\Coefficier');
    }
}
