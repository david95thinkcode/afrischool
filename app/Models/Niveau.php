<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $table = 'niveaux';

    public $timestamps = true;

    /**
     * Plusieurs classes ont un même niveau
     */
    public function classes()
    {
        return $this->hasMany('App\Models\Classe');
    }
}
