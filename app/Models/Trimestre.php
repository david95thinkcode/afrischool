<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    protected $table = 'trimestres';

    public $timestamps = true;

    /**
     * Un trimestre a beaucoup de notes
     */
    public function notes()
    {
        return $this->hasMany('App\Models\Note');
    }
}
