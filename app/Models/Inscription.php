<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $table = 'inscriptions';
    
    public $timestamps = true;

    /**
     * Une inscription appartient à un élève
     */
    public function eleve()
    {
        // return $this->belongsTo('App\Models\Eleve', 'eleve_id');
    }

    /**
     * Une inscription est pour une classe
     */
    public function classe()
    {
        // return $this->belongsTo('App\Models\Classe', 'classe_id');
    }

    /**
     * Une inscription est relative a une année scolaire
     */
    public function anneescolaire()
    {
        return $this->belongsTo('App\Models\AnneeScolaire', 'annee_scolaire_id');
    }
}
