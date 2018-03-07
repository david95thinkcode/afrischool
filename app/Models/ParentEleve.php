<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Ne pas utiliser Parent comme nom de model 
 * parce c'est un nom réservé par Laravel
 */
class ParentEleve extends Model
{
    protected $table = "parents";

    public $timestamps = true;

    /**
     * Un parent a plusieurs enfants
     */
    public function eleves()
    {
        $this->hasMany('App\Models\Eleves');
    }
}
