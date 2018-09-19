<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = "classes";

    public $timestamps = true;

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

    /**
     * Une classe a plusieurs "professeur principal" 
     */
    public function professeursprincipal()
    {
        return $this->hasMany('App\Models\ProfesseurPrincipal');
    }

     /**
     * Une classe a beaucoup de notes
     */
    public function notes()
    {
        return $this->hasMany('App\Models\Note');
    }

    /**
     * eleve ayant une note dans cette classe
     */
    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'notes', 'classe_id', 'eleve_id');
    }

    //fourniture pas class
    public function fournitures()
    {
        return $this->hasMany(Fourniture::class);
    }
}
