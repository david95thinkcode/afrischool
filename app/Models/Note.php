<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    public $timestamps = true;

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function matiere()
    {
        return $this->belongsTo('App\Models\Matiere');
    }

    public function trimestre()
    {
        return $this->belongsTo('App\Models\Trimestre');
    }

    public function evaluation()
    {
        return $this->belongsTo('App\Models\Evaluation');
    }

    public function eleve()
    {
        return $this->belongsTo('App\Models\Eleve');
    }
}
