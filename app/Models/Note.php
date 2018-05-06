<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = [
        'evaluation_id','trimestre_id','matiere_id','classe_id','eleve_id', 'not_note', 'annee_scolaire_id'
    ];

    public $timestamps = true;

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function matiere()
    {
        return $this->belongsTo('App\Models\Matiere');
    }

    public function trimestre()
    {
        return $this->belongsTo('App\Models\Trimestre');
    }

    public function evaluation()
    {
        return $this->belongsTo('App\Models\Evaluation');
    }

    public function eleve()
    {
        return $this->belongsTo('App\Models\Eleve');
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }
}
