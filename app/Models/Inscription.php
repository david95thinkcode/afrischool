<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $table = 'inscriptions';

    protected $fillable = [
        'montant_scolarite', 'montant_verse', 'classe_id', 'reste',
        'annee_scolaire_id', 'eleve_id', 'date_inscription', 'est_solder'
    ];
    
    public $timestamps = true;

    public function getMontantPayeAttribute()
    {
        return PaiementScolarite::where('inscription_id', $this->attributes['id'])->sum('montant');
    }

    public function getMontantRestantAttribute()
    {
        return $this->attributes['montant_scolarite'] - PaiementScolarite::where('inscription_id', $this->attributes['id'])->sum('montant');
    }

    /**
     * Retourne true si entièrement soldée
     * false sinon mais en faisant des calculs sur les paiements effectué
     * Et non affichant simplement la propriété est_solder du model
     */
    public function getIsPaidAttribute()
    {
        return (($this->attributes['montant_scolarite'] - PaiementScolarite::where('inscription_id', $this->attributes['id'])->sum('montant')) == 0) ? true : false;
    }

    /**
     * Une inscription appartient à un élève
     */
    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id');
    }

    /**
     * Une inscription est pour une classe
     */
    public function classe()
    {
        return $this->belongsTo('App\Models\Classe', 'classe_id');
    }

    /**
     * Une inscription est relative a une année scolaire
     */
    public function anneescolaire()
    {
        return $this->belongsTo('App\Models\AnneeScolaire', 'annee_scolaire_id');
    }
}
