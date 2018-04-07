<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $table = 'matieres';

    public $timestamps = true;

    /**
     * Une matière a plusieurs coefficient
     */
    public function coefficients()
    {
        return $this->hasMany('App\Models\Coefficier');
    }

    /**
     * Une matière est enseignée par plusieurs professeurs dans plusieurs classes
     */
    public function enseigner()
    {
        return $this->hasMany('App\Models\Enseigner');
    }
}
