<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horaire extends Model
{

    protected $table = 'horaires';

    public $timestamps = true;

    public function enseigner()
    {
        return $this->belongsTo(Enseigner::class, 'enseigner_id');
    }

    public function jour()
    {
        return $this->belongsTo(Jour::class, 'jour_id');
    }
}
