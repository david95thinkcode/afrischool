<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    protected $table = 'eleves';

    public $timestamps = true;

    /**
     * Un elève a un parent
     */
    public function parents()
    {
        return $this->belongsTo('App\Models\ParentEleve', 'parent_id');
    }

    /**
     * Un élève peut être être inscrit plusieurs fois
     */
    public function inscription()
    {
        return $this->hasMany('App\Models\Inscription');
    }

    public function inscriptionNonSolder()
    {
        return $this->inscription()->where('reste', '>', 0);
    }

    /**
     * eleve ayant une note dans cette classe
     */
    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'notes', 'classe_id', 'eleve_id');
    }

}
