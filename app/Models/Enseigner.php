<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enseigner extends Model
{
    use SoftDeletes;

    protected $table = 'enseigner';

    public $timestamps = true;
    
    protected $dates = ['deleted_at'];

    /**
     * Une matière est enseignée dans une classe
     */
    public function matiere()
    {
        return $this->belongsTo('App\Models\Matiere', 'matiere_id');
    }

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    /**
     * Une matière est enseignée dans une classe par un professeur
     */
    public function professeur()
    {
        return $this->belongsTo('App\Models\Professeur', 'professeur_id');
    }
    
    /**
     * 
     */
    public function anneescolaire()
    {
        return $this->belongsTo('App\Models\AnneeScolaire', 'annee_scolaire_id');
    }

    public function horaires()
    {
        return $this->hasMany(Horaire::class);
    }
    
}
