<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesseurPrincipal extends Model
{
    protected $table = 'professeur_principal';

    public $timestamps = true;

    /**
     * Une professseur est désigné comme principal dans une classe pour une année scolaire donnée
     */
    public function professeur()
    {
        return $this->belongsTo('App\Models\Professeur');
    }
    
    /**
     * 
     */
    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    /**
     * 
     */
    public function anneescolaire()
    {
        return $this->belongsTo('App\Models\AnneeScolaire', 'annee_scolaire_id');
    }
}
