<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horaire extends Model
{

    protected $table = 'horaires';

    public $timestamps = true;

    public function enseigner()
    {
        return $this->belongsTo('App\Models\Enseigner', 'enseigner_id');
    }

    public function jour()
    {
        return $this->belongsTo('App\Models\Jour', 'jour_id');
    }
}
