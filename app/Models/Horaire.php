<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Horaire extends Model
{
    use SoftDeletes;

    protected $table = 'horaires';

    public $timestamps = true;
    
    protected $dates = ['deleted_at'];

    public function enseigner()
    {
        return $this->belongsTo(Enseigner::class, 'enseigner_id');
    }

    public function jour()
    {
        return $this->belongsTo(Jour::class, 'jour_id');
    }
}
