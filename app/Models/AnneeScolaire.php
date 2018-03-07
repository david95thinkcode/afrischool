<?php

namespace App;

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
}
