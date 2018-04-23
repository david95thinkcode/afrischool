<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeEvaluation extends Model
{
    protected $table = 'types_evaluation';

    public $timestamps = true;

    /**
     * Plusieurs évaluations appartiennent à un même type d'évaluation
     */
    public function evaluations()
    {
        return $this->hasMany('App\Models\Evaluation');
    }
}
