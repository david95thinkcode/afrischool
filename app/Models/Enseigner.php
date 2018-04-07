<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseigner extends Model
{
    protected $table = 'enseigner';

    public $timestamps = true;

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
        return $this->belongsTo('App\Models\Professeur');
    }
}
