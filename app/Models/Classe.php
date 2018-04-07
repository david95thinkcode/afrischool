<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = "classes";

    public $timestamps = true;

    /**
     * une classe a un professeur principal
     */
    public function professeur()
    {
        return $this->belongsTo('App\Models\Professeur'); //professeur_id
    }

    /**
     * une classe a appartient à un niveau
     */
    public function niveau()
    {
        return $this->belongsTo('App\Models\Niveau');
    }

    /**
     * Plusieurs matières sont enseignées dans une classe
     */
    public function enseigner()
    {
        return $this->hasMany('App\Models\Enseigner');
    }

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
