<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $table = 'absences';
    
    public $timestamps = true;

    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'inscription_id');
    }

    public function horaire()
    {
        return $this->belongsTo(Horaire::class, 'horaire_id');
    }
}
