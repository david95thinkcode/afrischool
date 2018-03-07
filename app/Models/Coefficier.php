<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coefficier extends Model
{
    protected $table = 'coefficier';
    
    public $timestamps = true;

    /**
     * Un coefficient est pour une matière
     */
    public function matiere()
    {
        return $this->belongsTo('App\Models\Matiere', 'matiere_id');
    }

    public function classe()
    {
        
    }
}
