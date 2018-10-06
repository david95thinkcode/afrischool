<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    protected $table = "professeurs";

    public $timestamps = true;

    /**
     * Age accessor
     */
    public function getAgeAttribute()
    {
        return date('Y') - date('Y', strtotime($this->attributes['prof_date_naissance'])) . ' ans ';
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['prof_prenoms'] . ' ' . $this->attributes['prof_nom'];
    }

    /**
     * Un professeur enseigne plusieurs matières
     */
    public function enseigner()
    {
        return $this->hasMany(Enseigner::class);
    }

    /*
    * Un professeur a des diplomes
    */
    public function diplomes()
    {
        return $this->hasMany(Diplome::class, 'professeur_id');
    }

    /**
     * Un professeur peut être désigné comme principal plusieurs fois
     */
    public function professeursprincipal()
    {
        return $this->hasMany('App\Models\ProfesseurPrincipal');
    }
}
