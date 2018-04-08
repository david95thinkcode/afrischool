<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    protected $table = 'annees_scolaires';
    
    public $timestamps = true;

    /**
     * Il y a plusieurs inscriptions dans une année scolaire
     */
    public function inscriptions()
    {
        return $this->hasMany('App\Models\Inscription');
    }

    /**
     * Une année compte plusieurs " professeur principal " pour une année scolaire
     */
    public function professeursprincipal()
    {
        return $this->hasMany('App\Models\ProfesseurPrincipal');
    }
}
