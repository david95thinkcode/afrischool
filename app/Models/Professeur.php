<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    protected $table = "professeurs";

    public $timestamps = true;

    /**
     * Un professeur peut être professeur principal dans plusieurs classes
     */
    public function classes()
    {
        return $this->hasMany('App\Models\Classe');
    }

    /**
     * Un professeur enseigne plusieurs matières
     */
    public function enseigner()
    {
        return $this->hasMany('App\Models\Enseigner');
    }

    /*
    * Un professeur a des diplomes
    */
    public function diplomes()
    {
        return $this->hasMany('App\Models\Diplome', 'professeur_id');
    }
}
