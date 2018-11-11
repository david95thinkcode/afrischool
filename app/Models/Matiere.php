<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matiere extends Model
{
    use SoftDeletes;

    protected $table = 'matieres';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

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

    /**
     * Une matière a beaucoup de notes
     */
    public function notes()
    {
        return $this->hasMany('App\Models\Note');
    }
}
