<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';

    public $timestamps = true;

    /**
     * Une évaluation appartient à un type d'évaluation
     */
    public function type()
    {
        return $this->belongsTo('App\Models\TypeEvaluation', 'type_evaluation_id');
    }

     /**
     * Une évaluation a beaucoup de notes
     */
    public function notes()
    {
        return $this->hasMany('App\Models\Note');
    }
}
