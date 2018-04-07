<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    protected $table = "diplomes";

    public $timestamps = 'false' ;

    /*
    *   Un diplome appartient à un professeur
    */
    public function professeur()
    {
        return $this->belongsTo("App\Models\Professeur");
    }
}
